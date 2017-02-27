<?php

class CSRF_Protect
{
    /**
     * The namespace for the session variable and form inputs
     * @var string
     */
    public $namespace;

    /**
     * Initializes the session variable name, starts the session if not already so,
     * and initializes the token
     *
     * @param string $namespace
     */
    public function __construct($namespace = '_csrf')
    {
        $this->namespace = $namespace;

        if (session_id() === '') {
            session_start();
        }

        $this->setToken();
    }

    /**
     * Return the token from persistent storage
     *
     * @return string
     */
    public function getToken()
    {
        return $this->readTokenFromStorage();
    }

    /**
     * Verify if supplied token matches the stored token
     *
     * @param string $userToken
     * @return boolean
     */
    public function isTokenValid($userToken)
    {
        return ($userToken === $this->readTokenFromStorage());
    }

    /**
     * Echoes the HTML input field with the token, and namespace as the
     * name of the field
     */
    public function echoInputField()
    {
        $token = $this->getToken();
        echo "<input type=\"hidden\" name=\"{$this->namespace}\" value=\"{$token}\" />";
    }

    /**
     * Verifies whether the post token was set, else dies with error
     */
    public function verifyRequest()
    {
        $data = $this->isTokenValid($_POST[$this->namespace]);
        if (!$data) {
            die("CSRF validation failed.");
        }
    }

    /**
     * Generates a new token value and stores it in persisent storage, or else
     * does nothing if one already exists in persisent storage
     */
    public function setToken()
    {
        $storedToken = $this->readTokenFromStorage();

        if ($storedToken === '') {
            $token = md5(uniqid(rand(), TRUE));
            $this->writeTokenToStorage($token);
        }
    }

    /**
     * Reads token from persistent sotrage
     * @return string
     */
    public function readTokenFromStorage()
    {
        if (isset($_SESSION[$this->namespace])) {
            return $_SESSION[$this->namespace];
        } else {
            return '';
        }
    }

    /**
     * Writes token to persistent storage
     */
    public function writeTokenToStorage($token)
    {
        $_SESSION[$this->namespace] = $token;
    }

    public function unset_token($token)
    {
        unset($_SESSION[$this->namespace]);
    }
}
?>