<?php


class DecisionTree extends Tree
{
    private $training_data;
    private $display_debug;

    public function __construct($csv_with_header, $display_debug=0) {
        $this->display_debug = $display_debug;
        $this->training_data = $this->csv_to_array_outcome($csv_with_header);
        $this->meta_ans_val  = $this->training_data['meta_ans_val'];
        array_pop($this->training_data['header']);
        parent::__construct(new Node('Root'));
        $this->find_root($this->root, 'Any', $this->training_data);
    }

    public function predict_outcome($data_file , $db_data = array()) {

        if(count($db_data) > 0)
        {
            $this->input_data = $this->get_data_from_db_array($db_data);
        }else{
            $this->input_data = $this->csv_to_array_income($data_file);
        }


        $data 	= $this->input_data['samples'];
        $header = $this->input_data['header'];
        //$row = $data[0];
        //print_r($row);
        foreach($data as $k => $row) {
            $row['result'] = $this->predict($this->root, $row);
            $data[$k] = $row;
        }
        echo "\n";
        //print_r($data);
    }

    private function predict($node, $data_row) {
         /*print_r("\ntesting node====================\n");
         print_r($node);
         print_r("\ntesting data row====================\n");
         print_r($data_row);
         print_r("\n ################################## \n");*/
        //we have reached a leaf node
        if ( !count($node->namedBranches) ) {
            print_r('<span style="color: red">'."\nReturning " . $node->value.'</span>');
            return '<span style="color: red">'.$node->value.'</span>';
        }
        if ( array_key_exists($node->value, $data_row) ) {
            print_r("\nValue of " . $node->value . " is " . $data_row[$node->value]);
            if ( array_key_exists($data_row[$node->value], $node->namedBranches) ) {
                print_r("\nBranch " . $data_row[$node->value] . " exists and leads to node " . $node->namedBranches[$data_row[$node->value]]->value);
                $next_node = $node->namedBranches[$data_row[$node->value]];
                return($this->predict($next_node, $data_row));
            }
            /*if ( $value != null ) {
                return $value;
            }
        }
        else {
            print_r ("\nReturning " . $node->value);
            return $node->value;
        }*/
        }
        print_r("\nInvalid path");
        return null;
    }

    private function csv_to_array_outcome($filename='', $delimiter=',')
    {
        //Disease Data
        //$disease_risk_factor_list = $this->getDiseaseRiskFactorList();
        $training_data['header'] 	= $this->getDiseaseRiskColumnName();
        $training_data['samples'] 	= $this->getDiseaseRiskFactorList();
        $training_data['meta_ans_val'] 	= $this->getDiseaseAnsList();
       /* echo "OUTCOME ==================<pre>";
        print_r($training_data);
        echo "</pre>";*/
        return $training_data;
    }

    private function csv_to_array_income($filename='', $delimiter=',')
    {

        //User Data
        //$disease_risk_factor_list = $this->getDiseaseRiskFactorList();
        $training_data['header'] 	= $this->getUserColumnName();
        $training_data['samples'] 	= $this->getUserRiskFactorList();
        $training_data['meta_ans_val'] 	= array();
        /*echo "INCOME ==================<pre>";
        print_r($training_data);
        echo "</pre>";*/
        return $training_data;
    }



    private function get_mata_values($sample_arr)
    {
        $arr_ans = array();
        foreach ($sample_arr as $value) {
            if(key_exists('value' ,$value))
            {
                if (!in_array($value['value'], $arr_ans)) {
                    $arr_ans[] = $value['value'];
                }
            }
        }
        return $arr_ans;
    }

    private function find_root($parent_node, $branch_name, $training_data) {
        if ( $parent_node->value == 'Root' ){
            if ($this->display_debug){print_r("Node:Root  Branch:Any\n");}
        } else {
             if ($this->display_debug){print_r("Node:" . $parent_node->value . " Branch:" . $branch_name . "\n");}
        }
          if ($this->display_debug){print_r("\nThis is the data we are working on:\n");}
          if ($this->display_debug){print_r($training_data);}

        $S 		= $training_data['samples'];
        $header = $training_data['header'];

        $p = $this->possible_values($S, 'value');
        if ( count($p) == 1 )
        {
            reset($p);
                 if ($this->display_debug){print_r("End of this branch with value:" . strtoupper(key($p)) . "!!\n\n");}
            $parent_node->namedBranches[$branch_name] = new Node(strtoupper(key($p)));
            return;
        }
        $winning_attribute = 'none';
        foreach (array_keys($header) as $h) {
            $g = $this->gain($S, $h);
            if ( empty($max_gain) || ($g > $max_gain) ) {
                $max_gain = $g;
                $winning_attribute = $h;
            }
        }
        if ( $parent_node->value != 'Root' ) {
            $parent_node->namedBranches[$branch_name] = new Node($winning_attribute);
            $parent_node = $parent_node->namedBranches[$branch_name];
        } else {
            $parent_node->value = $winning_attribute;
        }

         if ($this->display_debug){print_r("New Root attribute:" . $winning_attribute . "\n");}
        $p = $this->possible_values($S, $winning_attribute);
        foreach ($p as $value => $count) {
            $subset = $this->create_subset($training_data, $winning_attribute, $value);
                if ($this->display_debug){print_r($winning_attribute . "->" . $value . "\n");}
            $this->find_root($parent_node, $value, $subset);
        }
        return;
    }

    private function gain($s, $attr) {
          if ($this->display_debug){print_r("Finding Gain for " . $attr . "...\n");}
        $gain_reduction = 0.0;
        $total_count = count($s);

        $possible_values_count = $this->possible_values($s, $attr);
           if ($this->display_debug){print_r($possible_values_count);}
           if ($this->display_debug){print_r("Sigma terms:");}
        foreach ($possible_values_count as $k => $v) {
            $e = $this->entropy($s, $attr, $k);
            $gain_reduction += $v * $e  / $total_count;
                  if ($this->display_debug){print_r("\n|Sn|:" . $v . " |S|:" . $total_count . " Entropy(Sn):" . $e);}
        }
        $e = $this->entropy($s);
        $ret = $e - $gain_reduction;
            if ($this->display_debug){print_r("\nGain for " . $attr . ": " . $ret . "\n\n");}
        return $ret;
    }

    private function entropy($s, $attr=null, $value=null) {
        if ( $attr != null ) {
            $p = $this->calculate_p($s, $attr, $value);
                if ($this->display_debug){print_r("\nEntropy of attribute " . $attr . "/" . $value. ": " );}
        }
        else {
            $p = $this->calculate_p($s, null, null);
                if ($this->display_debug){print_r("\nEntropy of the system: " );}
        }
        

        $ret = $this->get_entropy_ret_aii($p);
         if ($this->display_debug){print_r($ret);}
        /*if ($this->display_debug){print_r("=");}
        if ($this->display_debug){print_r($ret_aii);}*/
        return $ret;
    }

    private function get_entropy_ret_aii($p)
    {
        $ret = '0';
        foreach($this->meta_ans_val as $key => $value)
        {
            $ret = $ret + ( $p[$value] ? - $p[$value] * log($p[$value], 2): 0);
            //print_r("\n $value = ".( $p[$value] ? - $p[$value] * log($p[$value], 2): 0)."\n");
        }
        return $ret;
    }

    private function calculate_p($s, $attr, $attr_value) {
        if ($attr != null) {
              if ($this->display_debug){print_r("\nCalculating p's for " . $attr . " with a value of " . $attr_value . ":");}
        }
        else {
               if ($this->display_debug){print_r("\nCalculating p's for the entire system:");}
        }
        //$p = array('no'=> 0, 'yes' => 0);
        //$p = array('Bus'=> 0, 'Train' => 0 , 'Car' => 0);
        $p = $this->get_p_arr_aii();

        try {
            foreach($s as $si) {
                if ( $attr == null ) {
                    if(!key_exists($si['value'] , $p))
                    {
                        $p[$si['value']] = 0;
                    }
                    $p[$si['value']]++;
                }
                else if ( $si[$attr] ==  $attr_value ) {
                    if(!key_exists($si['value'] , $p))
                    {
                        $p[$si['value']] = 0;
                    }
                    $p[$si['value']]++;
                }
            }
            /*print_r("\t\t" . __FUNCTION__ . "::value of p:");
            print_r($p);
            print_r("\t\t\n}" );*/

            //$total = $p['yes'] + $p['no'];
            //$total = $p['Bus'] + $p['Train'] + $p['Car'];
            $total = $this->get_p_arr_ttl_aii($p);

            //if ($this->display_debug){print_r("\nYES:". $p['yes'] . "  NO:" . $p['no'] . "  TOTAL:" . $total);}
            //if ($this->display_debug){print_r("\nBus:". $p['Bus'] . "  Train:" . $p['Train'] . "  Car:" . $p['Car'] . "  TOTAL:" . $total);}
             if ($this->display_debug){print_r($this->get_debug_p_arr_ttl_aii($p));}
            if ($total != 0) {
                /*$p['yes'] 	/= $total;
                $p['no'] 	/= $total;*/

                /*$p['Bus'] 	/= $total;
                $p['Train'] 	/= $total;
                $p['Car'] 	/= $total;*/

                $p = $this->get_p_arr_devide_by_ttl_aii($p , $total);
            }
            else {
                die("You are dividing by ZERO, idiot!");
            }
        }
        catch (Exception $e) {
            die("\n" . $e->getMessage());
        }
        return ($p);
    }

    private function get_p_arr_aii()
    {
        //$p = array('Bus'=> 0, 'Train' => 0 , 'Car' => 0);
        $p = array();
        foreach($this->meta_ans_val as $value)
        {
            $p[$value] = 0;
        }
        return $p;
    }

    private function get_p_arr_ttl_aii($p)
    {
        $ttl = 0;
        foreach($this->meta_ans_val as $value)
        {
            $ttl += $p[$value];
        }
        return $ttl;
    }

    private function get_debug_p_arr_ttl_aii($p)
    {
        $str = "\n";
        $ttl = 0;
        foreach($this->meta_ans_val as $value)
        {
            $ttl += $p[$value];
            $str .= "$value: ". $p[$value];
        }
        $str .= "  TOTAL:". $ttl."\n";
        echo $str;
    }
    private function get_p_arr_devide_by_ttl_aii($p , $total)
    {
        foreach($this->meta_ans_val as $value)
        {
            $p[$value] 	/= $total;
        }
        return $p;
    }

    private function possible_values($s, $attr) {
        $possible_values_count = array();
        foreach ($s as $si) {
            $possible_values_count[$si[$attr]] = array_key_exists($si[$attr], $possible_values_count) ? $possible_values_count[$si[$attr]] + 1 : 1;
        }
        return $possible_values_count;
    }

    private function create_subset($data, $target_attribute, $value) {
        $header 	= $data['header'];
        $samples 	= $data['samples'];

        unset($header[$target_attribute]);
        foreach ($samples as $si) {
            if ( $si[$target_attribute] == $value ) {
                unset($si[$target_attribute]);
                $new_samples[] = $si;
            }
        }
        $new_data['header'] = $header;
        $new_data['samples'] = $new_samples;
        return($new_data);
    }
}