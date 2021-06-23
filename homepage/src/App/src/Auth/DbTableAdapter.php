<?php
namespace App\Auth;

use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Db\Adapter\AdapterInterface as DbAdapterInterface;
use Laminas\Authentication\Result;

class DbTableAdapter implements AdapterInterface
{
    private $identityColumn;
    private $credentialColumn;
    private $identity;
    private $credential;
    /** @var DbAdapterInterface **/
    private $adapter;
    private $tableName;
    
    public function __construct(DbAdapterInterface $adapter = null)
    {
        $this->adapter = $adapter;
    }
    
    public function setAdapter(DbAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }
    
    public function setIdentityColumn(string $identityColumn)
    {
        $this->identityColumn = $identityColumn;
        return $this;
    }
    
    public function setCredentialColumn(string $credentialColumn)
    {
        $this->credentialColumn = $credentialColumn;
        return $this;
    }
    
    public function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }
    
    public function setIdentity(string $identity)
    {
        $this->identity = $identity;
        return $this;
    }
    
    public function setCredential(string $credential)
    {
        $this->credential = $credential;
        return $this;
    }
    
    public function authenticate()
    {
        $resultSet = $this->adapter->query("SELECT * FROM `{$this->tableName}` WHERE `{$this->identityColumn}` = ? and `{$this->credentialColumn}` = ?", 
            [$this->identity,$this->credential]);
        $result = new Result(Result::FAILURE, $this->identity);
        if ($resultSet->count() > 0){
            $result = new Result(Result::SUCCESS, $this->identity);
        }
        return $result;
    }
}