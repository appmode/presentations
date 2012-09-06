<?

//----------------------------------------------------------------------------//
// aphplixMultiLevelToken
//----------------------------------------------------------------------------//
/**
 * aphplixMultiLevelToken
 *
 * Multi Level Token Object
 *
 * Multi Level Token Object
 *
 * @prefix	mtok
 *
 * @package	aphplix
 * @class	MultiLevelToken
 */
class aphplixMultiLevelToken
{
	//------------------------------------------------------------------------//
	// Properties
	//------------------------------------------------------------------------//
	private $_arrPath;
	private $_strCurrent;
	private $_objOwner;
	
	//------------------------------------------------------------------------//
	// __construct
	//------------------------------------------------------------------------//
	/**
	 * __construct()
	 *
	 * Token constructor
	 *
	 * Token constructor
	 *
	 * @return	MenuToken
	 *
	 * @method
	 */
	function __construct($objOwner)
	{
		$this->_objOwner 	= $objOwner;
		$this->_strCurrent	= NULL;
		$this->_arrPath		= NULL;
	}
	
	
	//------------------------------------------------------------------------//
	// NewPath
	//------------------------------------------------------------------------//
	/**
	 * NewPath()
	 *
	 * Token Object takes form of the passed item and returns itself
	 *
	 * Token Object takes form of the passed item and returns itself
	 *
	 * @param	DBObject		$objOwner		The owner object
	 * @param	string			$strName		The name of the first level in the path
	 *
	 * @return	MenuToken
	 *
	 * @method
	 */
	function NewPath($strName)
	{
		$this->_strCurrent	= $strName;
		$this->_arrPath		= Array($strName);
	}
	
	
	//------------------------------------------------------------------------//
	// __get
	//------------------------------------------------------------------------//
	/**
	 * __get()
	 *
	 * Token Object takes form of the passed item and returns itself
	 *
	 * Token Object takes form of the passed item and returns itself
	 *
	 * @param	string	$strName	item name
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __get($strName)
	{
		$this->_strCurrent	= $strName;
		$this->_arrPath[]	= $strName;
		return $this;
	}
	
	
	//------------------------------------------------------------------------//
	// __call
	//------------------------------------------------------------------------//
	/**
	 * __call()
	 *
	 * Creates a new item with this name
	 *
	 * Creates a new item with this name
	 *
	 * @param	string	$strItem		Item to create
	 * @param	array	$arrArguments		Passed Arguments where first and only member should be the value
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __call($strMethod, $arrArguments)
	{
		$this->_objOwner->arrPath = $this->_arrPath;
		return call_user_func_array(Array($this->_objOwner, $strMethod), $arrArguments);
	}
}

//----------------------------------------------------------------------------//
// aphplixSingleLevelToken
//----------------------------------------------------------------------------//
/**
 * aphplixSingleLevelToken
 *
 * Single Level Token Object
 *
 * Single Level Token Object
 *
 * @prefix	stok
 *
 * @package	aphplix
 * @class	SingleLevelToken
 */
class aphplixSingleLevelToken
{
	//------------------------------------------------------------------------//
	// Properties
	//------------------------------------------------------------------------//
	private $_objOwner;
	private $_strProperty;
	private $_mixValue;
	
	//------------------------------------------------------------------------//
	// __construct
	//------------------------------------------------------------------------//
	/**
	 * __construct()
	 *
	 * Token constructor
	 *
	 * Token constructor
	 *
	 * @return	SingleLevelToken
	 *
	 * @method
	 */
	function __construct()
	{

	}
	
	//------------------------------------------------------------------------//
	// SetPersonality
	//------------------------------------------------------------------------//
	/**
	 * SetPersonality()
	 *
	 * Sets the personality of the Token Object
	 *
	 * Sets the personality of the Token Object
	 *
	 * @param	object		$objOwner		The owner of the token object
	 * @param	string		$strProperty		The property of the token object
	 *
	 * @return	MenuToken
	 *
	 * @method
	 */
	function SetPersonality($objOwner, $strProperty)
	{
		$this->_objOwner	= $objOwner;
		$this->_strProperty	= $strProperty;
	}
	
	//------------------------------------------------------------------------//
	// __call
	//------------------------------------------------------------------------//
	/**
	 * __call()
	 *
	 * Calls a method on the owner
	 *
	 * Calls a method on the owner
	 *
	 * @param	string	$strMethod		Method to call
	 * @param	array	$arrArguments	Arguments to be passed to the method
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __call($strMethod, $arrArguments)
	{
		return $this->_objOwner->Token__Call($this->_strProperty, $strMethod, $arrArguments);
	}
	
	//------------------------------------------------------------------------//
	// __get
	//------------------------------------------------------------------------//
	/**
	 * __get()
	 *
	 * Gets a value from the owner
	 *
	 * Gets a value from the owner
	 *
	 * @param	string	$strName	Name of value to get
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __get($strName)
	{
		return $this->_objOwner->Token__Get($this->_strProperty, $strName);
	}
	
	//------------------------------------------------------------------------//
	// __set
	//------------------------------------------------------------------------//
	/**
	 * __set()
	 *
	 * Sets a value of the owner
	 *
	 * Sets a value of the owner
	 *
	 * @param	string	$strName	Name of value to set
	 * @param	mixed	$mixValue	Value to set
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __set($strName, $mixValue)
	{
		return $this->_objOwner->Token__Set($this->_strProperty, $strName, $mixValue);
	}
}


Class aphplixSingleLevelTokenOwner implements Iterator
{
	//------------------------------------------------------------------------//
	// Properties
	//------------------------------------------------------------------------//
	protected $_arrProperty;
	protected $_objToken;
	
	//------------------------------------------------------------------------//
	// __call
	//------------------------------------------------------------------------//
	/**
	 * __call()
	 *
	 * Calls a method
	 *
	 * Calls a method
	 *
	 * @param	string	$strMethod		Method to call
	 * @param	array	$arrArguments	Arguments to be passed to the method
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __call($strMethod, $arrArguments)
	{
		// return a property if it is set
		if (isset($this->_arrProperty[$strMethod]))
		{
			return $this->_arrProperty[$strMethod];
		}
		else
		{
			return NULL;
		}
	}
	
	//------------------------------------------------------------------------//
	// __get
	//------------------------------------------------------------------------//
	/**
	 * __get()
	 *
	 * Gets a value
	 *
	 * Gets a value
	 *
	 * @param	string	$strName	Name of value to get
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __get($strName)
	{
		// return a token
		$stokToken = Singleton('aphplixSingleLevelToken');
		$stokToken->SetPersonality($this, $strName);
		return $stokToken;
	}
	
	//------------------------------------------------------------------------//
	// __set
	//------------------------------------------------------------------------//
	/**
	 * __set()
	 *
	 * Sets a value
	 *
	 * Sets a value
	 *
	 * @param	string	$strName	Name of value to set
	 * @param	mixed	$mixValue	Value to set
	 * 
	 * @return	mixed
	 *
	 * @method
	 */
	function __set($strName, $mixValue)
	{
		// set a property
		return $this->_arrProperty[$strName]['Value'] = $mixValue;
	}
	
	function Token__Get($strProperty, $strName)
	{
		if (isset($this->_arrProperty[$strProperty][$strName]))
		{
			// return an actual property of the property
			return $this->_arrProperty[$strProperty][$strName];
		}
		else
		{
			// return a calculated property
			return $this->_TokenProperty($strProperty, $strName);
		}
	}
	
	function Token__Set($strProperty, $strName, $mixValue)
	{
		return $this->_arrProperty[$strProperty][$strName] = $mixValue;
	}
	
	function Token__Call($strProperty, $strMethod, $arrArguments)
	{
		$strMethod = "_TokenMethod$strName";
		return $this->{$strMethod}($strProperty);
	}
	
	private function _TokenProperty($strProperty, $strName)
	{
		$strMethod = "_TokenProperty$strName";
		return $this->{$strMethod}($strProperty);
	}
	
	//------------------------------------------------------------------------//
	// rewind
	//------------------------------------------------------------------------//
	/**
	 * rewind()
	 *
	 * Iterator Reset
	 *
	 * Iterator Reset
	 *
	 * @method
	 */
	public function rewind()
	{
		reset($this->_arrProperty);
	}
	
	//------------------------------------------------------------------------//
	// current
	//------------------------------------------------------------------------//
	/**
	 * current()
	 *
	 * Gets current property's value
	 *
	 * Gets current property's value
	 * 
	 * @return	mixed			Current property's value
	 *
	 * @method
	 */
	public function current()
	{
		$stokToken = Singleton('aphplixSingleLevelToken');
		$stokToken->SetPersonality($this, key($this->_arrProperty));
		return $stokToken;
	}
	
	//------------------------------------------------------------------------//
	//key
	//------------------------------------------------------------------------//
	/**
	 * key()
	 *
	 * Gets current property's name
	 *
	 * Gets current property's name
	 * 
	 * @return	string			Current property's name
	 *
	 * @method
	 */
	public function key()
	{
		return key($this->_arrProperty);
	}
	
	//------------------------------------------------------------------------//
	// next
	//------------------------------------------------------------------------//
	/**
	 * next()
	 *
	 * Advances Iterator to the next property, and returns its value
	 *
	 * Advances Iterator to the next property, and returns its value
	 * 
	 * @return	mixed			Next property's value
	 *
	 * @method
	 */
	public function next()
	{
		next($this->_arrProperty);
		$stokToken = Singleton('aphplixSingleLevelToken');
		$stokToken->SetPersonality($this, key($this->_arrProperty));
		return $stokToken;
	}
	
	//------------------------------------------------------------------------//
	// valid
	//------------------------------------------------------------------------//
	/**
	 * valid()
	 *
	 * Checks whether there are any more properties
	 *
	 * Checks whether there are any more properties
	 * 
	 * @return	boolean
	 *
	 * @method
	 * @see	<MethodName()||typePropertyName>
	 */
	public function valid()
	{
		return !is_null($this->key());
	}
}

?>
