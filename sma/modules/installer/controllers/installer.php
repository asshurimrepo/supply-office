<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Installer Stock Manager Advance 
*
* @author			Mian Saleem
* @package			Stock Manager Advance (Invoice & Inventory System)
* @link				http://codecanyon.net/item/stock-manager-advance-invoice-inventory-system/3647040
* @copyright		© 2012 - 2013 Tecdiary IT Solutions
* @last modified	28/06/2013
*
**/

class Installer extends MX_Controller {

	public function __construct()
	{
		//Call constructor
		parent::__construct();
	    $this->load->language('installer');
    }

	public function index()
    
	{
	
		if($this->load->is_loaded('session') || class_exists('ion_auth') ) {
			redirect("module=installer&view=locked", 'refresh');
			exit;
		} 
		$data['title'] = 'Stock Manage Advance';
        $this->load->view('installer', $data);
	}
	
	public function locked()
    
	{
        $data['title'] = 'Installer Locked';
        $this->load->view('locked', $data);
	}
	
	public function setup($step=NULL, $data=NULL)
	{       
		if($this->load->is_loaded('session') || class_exists('ion_auth') ) {
			redirect("module=installer&view=locked", 'refresh');
			exit;
		} 
		
		   if($this->input->get('step')){ $step = $this->input->get('step'); } else { $step = NULL; }
		   
		   $this->load->helper('file');
		   $this->load->library('session');
		   $this->load->library('form_validation');
       
           switch($step){
            
                case '1':
                
                    $index_file = (''.getcwd().'/index.php');
                    
                    if(is_writable($index_file))
                    {
                        $index_file = 'Pass';
                    } else {
                        $index_file = 'Failed!';
                    }
					
					$config_folder = (''.getcwd().'/sma/config/');
                    
                    if(is_writable($config_folder))
                    {
                        $config_folder = 'Pass';
                    }
                    else
                    {
                        $config_folder = 'Failed!';
                    }
                    
                    $config_file = (''.getcwd().'/sma/config/config.php');
                    
                    if(is_writable($config_file))
                    {
                        $config_file = 'Pass';
                    } else {
                        $config_file = 'Failed!';
                    }
                    
                    $database_file = (''.getcwd().'/sma/config/database.php');
                    
                    if(is_writable($database_file))
                    {
                        $database_file = 'Pass';
                    } else {
                        $database_file = 'Failed!';
                    }
					
					$autoload_file = (''.getcwd().'/sma/config/autoload.php');
                    
                    if(is_writable($autoload_file))
                    {
                        $autoload_file = 'Pass';
                    } else {
                        $autoload_file = 'Failed!';
                    }
					
					$routes_file = (''.getcwd().'/sma/config/routes.php');
                    
                    if(is_writable($routes_file))
                    {
                        $routes_file = 'Pass';
                    } else {
                        $routes_file = 'Failed!';
                    }
					
					if(phpversion() < "5.3"){
						$php_version = 'Pass';
					} else { 
						$php_version = 'Failed';
					}
					
					if(extension_loaded('mbstring')){
						$mbstring = 'Pass';
					} else { 
						$mbstring = 'Failed';
					}
					
					if(extension_loaded('mysql')) {
						$mysql = 'Pass';
					} else { 
						$mysql = 'Failed';
					}
					
					if(extension_loaded('gd')){
						$gd_lib = 'Pass';
					} else { 
						$gd_lib = 'Failed';
					}
					
				/*$error = TRUE; echo "<div class='alert alert-error'>Your PHP version is ".phpversion()."! PHP 5.3 or higher required!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> You are running PHP ".phpversion()."</div>";} 
			if(!extension_loaded('mcrypt')){$error = TRUE; echo "<div class='alert alert-error'>Mcrypt PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> Mcrypt PHP exention loaded!</div>";}
			if(!extension_loaded('mysql')){$error = TRUE; echo "<div class='alert alert-error'>Mysql PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> Mysql PHP exention loaded!</div>";}
			if(!extension_loaded('mbstring')){$error = TRUE; echo "<div class='alert alert-error'>MBString PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> MBString PHP exention loaded!</div>";}
			if(!extension_loaded('gd')){echo "<div class='alert alert-error'>GD PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> GD PHP exention loaded!</div>";}
			if(!extension_loaded('pdo')){$error = TRUE; echo "<div class='alert alert-error'>PDO PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> PDO PHP exention loaded!</div>";}
			if(!extension_loaded('dom')){echo "<div class='alert alert-error'>DOM PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> DOM PHP exention loaded!</div>";}
			if(!extension_loaded('curl')){$error = TRUE; echo "<div class='alert alert-error'>CURL PHP exention missing!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> CURL PHP exention loaded!</div>";}
			if(!is_writeable($DBconfigFile)){$error = TRUE; echo "<div class='alert alert-error'>Database File (application/config/database.php) is not writeable!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> Database file is writeable!</div>";}
			if(!is_writeable("../files")){echo "<div class='alert alert-error'><img src='../assets/img/error.png' /> /files folder is not writeable!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> /files folder is writeable!</div>";}
			if(ini_get('allow_url_fopen') != "1"){echo "<div class='alert alert-warning'><img src='../assets/img/warning.png' /> Allow_url_fopen is not enabled!</div>";}else{echo "<div class='alert alert-success'><img src='../assets/blackline/img/success.png' /> Allow_url_fopen is enabled!</div>";}*/
			
                    
            		$data = array(	
						'index_file'			=> $index_file,
                        'config_folder'         => $config_folder,
                        'config_file'           => $config_file,
                        'database_file'         => $database_file,
						'autoload_file'         => $autoload_file,
                        'routes_file'           => $routes_file
					);
					
            				
            		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					$data['success_message'] = $this->session->flashdata('message');
					$data['title'] = 'Step 1 - Checking File/Folder Permissions';
        			$this->load->view('step1', $data);
					               
                break;
                
                case '2':
				
					//validate form input
					$this->form_validation->set_rules('db_host', 'Database Host', 'required|xss_clean');
					$this->form_validation->set_rules('db_name', 'Database Name', 'required|xss_clean');
					$this->form_validation->set_rules('db_user', 'Database Username', 'required|xss_clean');
					$this->form_validation->set_rules('db_password', 'Database Password', 'required|xss_clean');
						
					if ($this->form_validation->run() == true)
					{
						$this->session->set_flashdata('success_message', 'Database Successfully Installed');
						redirect("module=installer&view=setup&step=3", 'refresh');
                    /*
					$this->load->dbforge();
                        
                    //Everything was created, lets build our database creation script
                    if(!$this->db->table_exists('activity'))
                    {
                        // Create the fields for the activity table
                        $activity_fields = array(
                       
                            //Activity ID Field
                            'id' => array(
                                'type' => 'INT',
                                'constraint' => 16,
                                'auto_increment' => TRUE,
                            ),
                              
                            //Activity Username Field
                            'username' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                              
                            //Activity Date Field
                            'date' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                               
                            //Activity, Activity Field
                            'activity' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //activity, topic_id Field
                            'topic_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //activity, category_id Field
                            'category_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                        );
                            
                        // Add the activity fields into the dbforge.        
                        $this->dbforge->add_field($activity_fields);
                            
                        // Add Primary Key to the `id` field.
                        $this->dbforge->add_key('id');
                            
                        // Create the activity table using the dbforge.        
                        $this->dbforge->create_table('activity');
    
                        $failed[] = 'Success - Activity Table Installed'; 
                    }else{
                        $failed[] = 'Failed - Activity Table Failed!';
                    }
                        
                    //bookmarks table
                    if(!$this->db->table_exists('bookmarks'))
                    {
                        // Create the fields for the activity table
                        $bookmark_fields = array(
                            
                            //bookmark, `id` Field
                            'bookmark_id' => array(
                                'type' => 'INT',
                                'constraint' => 16,
                                'auto_increment' => TRUE,
                            ),
                               
                            //bookmark, `bookmark_topic_id` Field
                            'bookmark_topic_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //bookmark, `bookmark_topic_title` Field
                            'bookmark_topic_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //bookmark, `bookmark_user_id` Field
                            'bookmark_user_id' => array(
                                'type' => 'INT',
                                'constraint' => 16,
                            ),
                                
                            //bookmark, `bookmark_replys` Field
                            'bookmark_replys' => array(
                                'type' => 'INT',
                                'constraint' => 16,
                            ),
                        );
                        // Add the activity fields into the dbforge.        
                        $this->dbforge->add_field($bookmark_fields);
                         
                        // Add Primary Key to the `id` field.
                        $this->dbforge->add_key('bookmark_id');
                            
                        // Create the activity table using the dbforge.        
                        $this->dbforge->create_table('bookmarks');                        
    
                        $failed[] = 'Success - Bookmarks Table Installed'; 
                    }else{
                        $failed[] = 'Failed - Bookmarks Table Failed!';
                    }
                        
                   //category table
                   if(!$this->db->table_exists('category'))
                   {
                        // Create the fields for the activity table
                        $category_fields = array(
                            
                            //category, `CategoryID` Field
                            'CategoryID' => array(
                                'type' => 'INT',
                                'constraint' => 16,
                                'auto_increment' => TRUE,
                            ),
                                
                           //category, `parentID` Field
                           'parentID' => array(
                               'type' => 'INT',
                               'constraint' => 16,
                           ),    
                                
                           //category, `type` Field
                            'type' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //category, `Name` Field
                            'Name' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //category, `Description` Field
                            'Description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //category, `Active` Field
                            'Active' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                            ),
                        );
                        // Add the activity fields into the dbforge.        
                        $this->dbforge->add_field($category_fields);
                            
                        // Add Primary Key to the `id` field.
                        $this->dbforge->add_key('CategoryID');
                            
                        // Create the activity table using the dbforge.        
                        $this->dbforge->create_table('category');                           
    
                        $failed[] = 'Success - Category Table Installed'; 
                    }else{
                        $failed[] = 'Failed - Category Table Failed!';
                    }
                        
                   //Comments table
                    if(!$this->db->table_exists('comments'))
                    {
                        // Create the fields for the activity table
                        $comments_fields = array(
                            
                            //comments, `CommentID` Field
                            'CommentID' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //comments, `TopicID` Field
                           'TopicID' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //comments, `CategoryID` Field
                            'CategoryID' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //comments, `Title` Field
                            'Title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            //comments, `Body` Field
                            'Body' => array(
                                'type' => 'TEXT',
                            ),
                                
                            'CreatedBy' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            'PostTime' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 255,
                            ),
                                
                            'Active' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                            ),
                                
                            'reported' => array(
                                'type' => 'INT',
                                'constraint' => 10,
                            ),
                        );  
                        // Add the activity fields into the dbforge.        
                        $this->dbforge->add_field($comments_fields);
                           
                        // Add Primary Key to the `id` field.
                        $this->dbforge->add_key('CommentID');
                            
                        // Create the activity table using the dbforge.        
                        $this->dbforge->create_table('comments');
    
                        $failed[] = 'Success - Comments Table Installed'; 
                    }else{
                        $failed[] = 'Failed - Comments Table Failed!';
                    } 
                        
                       //groups table
                        if(!$this->db->table_exists('groups'))
                        {
                            // Create the fields for the activity table
                            $group_fields = array(
                            
                                //groups, `id` Field
                                'id' => array(
                                    'type' => 'MEDIUMINT',
                                    'constraint' => 8,
                                    'auto_increment' => TRUE,
                                ),
                                
                                //groups, `name` Field
                                'name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 20,
                                ),  
                                
                                //groups, `description` Field
                                'description' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 100,
                                ),
                            );
                            // Add the activity fields into the dbforge.        
                            $this->dbforge->add_field($group_fields);
                            
                            // Add Primary Key to the `id` field.
                            $this->dbforge->add_key('id');
                            
                            // Create the activity table using the dbforge.        
                            $this->dbforge->create_table('groups');
    
                            $failed[] = 'Success - Groups Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Groups Table Failed!';
                        }
                        
                       //meta table
                        if(!$this->db->table_exists('meta'))
                        {
                            // Create the fields for the activity table
                            $meta_fields = array(
                            
                                //meta, `id` Field
                                'id' => array(
                                    'type' => 'MEDIUMINT',
                                    'constraint' => 8,
                                    'auto_increment' => TRUE,
                                ), 
                                
                                //meta, `user_id` Field
                                'user_id' => array(
                                    'type' => 'MEDIUMINT',
                                    'constraint' => 8,
                                ),
                                
                                //meta, `first_name` Field
                                'first_name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //meta, `last_name` Field
                                'last_name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //meta, `location` Field
                                'location' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //meta, `interests` Field
                                'interests' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //meta, `occupation` Field
                                'occupation' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //meta, `gender` Field
                                'gender' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                            );
                            // Add the activity fields into the dbforge.        
                            $this->dbforge->add_field($meta_fields);
                            
                            // Add Primary Key to the `id` field.
                            $this->dbforge->add_key('id');
                            
                            // Create the activity table using the dbforge.        
                            $this->dbforge->create_table('meta');
                                                          
                            $failed[] = 'Success - Meta Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Meta Table Failed!';
                        }
                        
                       //plugins table
                        if(!$this->db->table_exists('plugins'))
                        {
                            // Create the fields for the activity table
                            $plugins_fields = array(
                            
                                //plugins, `plugin_id` Field
                                'plugin_id' => array(
                                    'type' => 'BIGINT',
                                    'constraint' => 20,
                                    'auto_increment' => TRUE,
                                ),    
                                
                                //plugins, `plugin_system_name` Field
                                'plugin_system_name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),             
                                
                                //plugins, `plugin_name` Field
                                'plugin_name' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //plugins, `plugin_uri` Field
                                'plugin_uri' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 120,
                                ),
                                
                                //plugins, `plugin_version` Field
                                'plugin_version' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 30,
                                ),
                                
                                //plugins, `plugin_description` Field
                                'plugin_description' => array(
                                    'type' => 'TEXT',
                                ),
                                
                                //plugins, `plugin_author` Field
                                'plugin_author' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 120,
                                ),
                                
                                //plugins, `plugin_author_uri` Field
                                'plugin_author_uri' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 120,
                                ),
                                
                                //plugins, `plugin_data` Field
                                'plugin_data' => array(
                                    'type' => 'LONGTEXT',
                                ),
                                
                                //plugins, `plugin_status` Field
                                'plugin_status' => array(
                                    'type' => 'TINYINT',
                                    'constraint' => 1,
                                ),
                            );
                            // Add the activity fields into the dbforge.        
                            $this->dbforge->add_field($plugins_fields);
                            
                            // Add Primary Key to the `id` field.
                            $this->dbforge->add_key('plugin_id');
                            
                            // Create the activity table using the dbforge.        
                            $this->dbforge->create_table('plugins');  
                            
                            $failed[] = 'Success - Plugins Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Plugins Table Failed!';  
                        }  
                                                     
                       //search table
                        if(!$this->db->table_exists('search'))
                        {
                            // Create the fields for the search table
                            $search_fields = array(
                            
                                //search, `id` Field
                                'id' => array(
                                    'type' => 'INT',
                                    'constraint' => 11,
                                    'auto_increment' => TRUE,
                                ), 
                                
                                //search, `query_string` Field
                                'query_string' => array(
                                    'type' => 'TEXT',
                                ),
                            );
                            // Add the search fields into the dbforge.        
                            $this->dbforge->add_field($search_fields);
                            
                            // Add Primary Key to the `id` field.
                            $this->dbforge->add_key('id');
                            
                            // Create the activity table using the dbforge.        
                            $this->dbforge->create_table('search'); 
                            
                            $failed[] = 'Success - Search Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Search Table Failed!';
                        }
                        
                        //settings table
                        if(!$this->db->table_exists('settings'))
                        {
                            // Create the fields for the settings table
                            $settings_fields = array(
                            
                                //settings, `id` Field
                                'id' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                            
                                //settings, `themeID` Field
                                'themeID' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `siteTheme` Field
                                'siteTheme' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //settings, `sName` Field
                                'sName' => array(
                                    'type' => 'TEXT',
                                ),
                                
                                //settings, `siteUrl` Field
                                'siteUrl' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //settings, `siteLanguage` Field
                                'siteLanguage' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //settings, `adminEmail` Field
                                'adminEmail' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //settings, `siteKeywords` Field
                                'siteKeywords' => array(
                                    'type' => 'TEXT',
                                ),
                                
                                //settings, `siteDescription` Field
                                'siteDescription' => array(
                                    'type' => 'TEXT',
                                ),
                                
                                //settings, `topicsPerPage` Field
                                'topicsPerPage' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `postsPerPage` Field
                                'postsPerPage' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `allowLogin` Field
                                'allowLogin' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `allowRegistration` Field
                                'allowRegistration' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `useGravatars` Field
                                'useGravatars' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `deleteOwnDiscussions` Field
                                'deleteOwnDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `editOwnDiscussions` Field
                                'editOwnDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `deleteOwnPosts` Field
                                'deleteOwnPosts' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `editOwnPosts` Field
                                'editOwnPosts' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `canStickyDiscussions` Field
                                'canStickyDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `canCloseDiscussions` Field
                                'canCloseDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `canReportDiscussions` Field
                                'canReportDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsDeleteDiscussions` Field
                                'modsDeleteDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsEditDiscussions` Field
                                'modsEditDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsDeletePosts` Field
                                'modsDeletePosts' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsEditPosts` Field
                                'modsEditPosts' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsStickyDiscussions` Field
                                'modsStickyDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsCloseDiscussions` Field
                                'modsCloseDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `modsReportDiscussions` Field
                                'modsReportDiscussions' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),                                
                                
                                //settings, `siteEnabled` Field
                                'siteEnabled' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings `allowEmailActivation` Field
                                'allowEmailActivation' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `siteWelcomeMessage` Field
                                'siteWelcomeMessage' => array(
                                    'type' => 'TEXT',
                                ),
                                
                                //settings, `adminTheme` Field
                                'adminTheme' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //settings, `siteVersion` Failed
                                'siteVersion' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 50,
                                ),
                                
                                //settings, `forumInstalled` Failed
                                'forumInstalled' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `blogInstalled` Field
                                'blogInstalled' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `blogTheme` Field
                                'blogTheme' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //settings, `forumsLayout` Failed
                                'forumsLayout' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                            );
                                
                            // Add the settings fields into the dbforge.        
                            $this->dbforge->add_field($settings_fields);
                            
                            // Create the settings table using the dbforge.        
                            $this->dbforge->create_table('settings');
                             
                            $failed[] = 'Success - Settings Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Settings Table Failed!';
                        }
                    
                        //themes table
                        if(!$this->db->table_exists('themes'))
                        {
                            // Create the fields for the themes table
                            $themes_fields = array(
                            
                                //themes, `themeID` Field
                                'themeID' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //themes, `themeName` Field
                                'themeName' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //themes, `themeLayout` Field
                                'themeLayout' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //themes, `themeDescription` Field
                                'themeDescription' => array(
                                    'type' => 'TEXT'
                                ),
                                
                                //themes, `themeAuthor` Field
                                'themeAuthor' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //themes, `themeActive Field
                                'themeActive' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                            );
                            
                            // Add the themes fields into the dbforge.        
                            $this->dbforge->add_field($themes_fields);
                            
                            // Create the themes table using the dbforge.        
                            $this->dbforge->create_table('themes'); 
                            
                            $failed[] = 'Success - Themes Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Themes Table Failed!';
                        }
                        
                        //topics table
                        if(!$this->db->table_exists('topics'))
                        {
                            // Create the fields for the topics table
                            $topic_fields = array(
                            
                                //topics, `TopicID` Field
                                'TopicID' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `TopicName` Field
                                'TopicName' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `CreatedBy` Field
                                'CreatedBy' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `LastPost` Field
                                'LastPost' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `CategoryID` Field
                                'CategoryID' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `CreatedTime` Field
                                'CreatedTime' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `LastPostTime` Field
                                'LastPostTime' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //topics, `Active` Field
                                'Active' => array(
                                    'type' => 'INT',
                                    'constraint' => 10,
                                ),
                                
                                //topics, `Sticky` Field
                                'Sticky' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //topics, `Closed` Field
                                'Closed' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                                
                                //topics, `flagged` Field
                                'Flagged' => array(
                                    'type' => 'INT',
                                    'constraint' => 16,
                                ),
                            );
                            
                            // Add the topics fields into the dbforge.        
                            $this->dbforge->add_field($topic_fields);
                            
                            // Add Primary Key to the `TopicID` field.
                            $this->dbforge->add_key('TopicID');
                            
                            // Create the topics table using the dbforge.        
                            $this->dbforge->create_table('topics');
                            
                            $failed[] = 'Success - Topics Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Topics Table Failed!';
                        }
                        
                        //users table
                        if(!$this->db->table_exists('users'))
                        {
                            // Create the fields for the users table
                            $users_fields = array(
                            
                                //users, `id` Field
                                'id' => array(
                                    'type' => 'MEDIUMINT',
                                    'constraint' => 8,
                                    'auto_increment' => TRUE,
                                ),
                                
                                //users, `group_id` Field
                                'group_id' => array(
                                    'type' => 'MEDIUMINT',
                                    'constraint' => 8,
                                ),
                                
                                //users, `ip_address` Field
                                'ip_address' => array(
                                    'type' => 'CHAR',
                                    'constraint' => 16,
                                ),
                                
                                //users, `username` Field
                                'username' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `password` Field
                                'password' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `salt` Field
                                'salt' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `email` Field
                                'email' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `activation_code` Field
                                'activation_code' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `forgotten_password_code` Field
                                'forgotten_password_code' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `remember_code` Field
                                'remember_code' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 40,
                                ),
                                
                                //users, `created_on` Field
                                'created_on' => array(
                                    'type' => 'INT',
                                    'constraint' => 11,
                                ),
                                
                                //users, 'last_login' Field
                                'last_login' => array(
                                    'type' => 'INT',
                                    'constraint' => 11,
                                ),
                                
                                //users, `signature` Field
                                'signature' => array(
                                    'type' => 'VARCHAR',
                                    'constraint' => 255,
                                ),
                                
                                //users, `active` Field
                                'active' => array(
                                    'type' => 'TINYINT',
                                    'constraint' => 1,
                                ),
                            );
                            
                            // Add the users fields into the dbforge.        
                            $this->dbforge->add_field($users_fields);
                        
                            // Add Primary Key to the `id` field.
                            $this->dbforge->add_key('id');
                            
                            // Create the users table using the dbforge.        
                            $this->dbforge->create_table('users');
    
                            $failed[] = 'Success - Users Table Installed'; 
                        }else{
                            $failed[] = 'Failed - Users Table Failed!';
                        }
                        
                        if($failed)
                        {
                            //Table have being created move on a step;
                            redirect('installer/setup/step3', 'refresh');
                        }  
					*/	
					
		   			}
					
					$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					$data['success_message'] = $this->session->flashdata('message');
					$data['title'] = 'Step 2 - Create Database and Tables';
        			$this->load->view('step2', $data);
				
					
                break;
                
                case '3':
				
				//validate form input
					$this->form_validation->set_rules('site_name', 'Site Name', 'required|xss_clean');
					$this->form_validation->set_rules('site_url', 'Site URL', 'required|prep_url|xss_clean');
					$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
					$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
					$this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|min_length[8]|max_length[16]');
					$this->form_validation->set_rules('company', 'Company', 'required|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
					$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');
						
					if ($this->form_validation->run() == true)
					{
						$this->session->set_flashdata('success_message', 'Site Configuration Successfully Saved');
						redirect("module=installer&view=done", 'refresh');
						/*
                            $this->load->database();
                            $install_info = $this->session->userdata('install_info');
                            
                            $settings_data = array(
                                'id' => '1',
                                'themeID' => '1',
                                'siteTheme' => 'default',
                                'sName' => $install_info['site_name'],
                                'siteUrl' => base_url(),
                                'siteLanguage' => 'english',
                                'adminEmail' => $install_info['admin_email'],
                                'siteKeywords' => 'test, key, words',
                                'siteDescription' => 'Dove Forums, Open source discussions forums software.',
                                'topicsPerPage' => '10',
                                'postsPerPage' => '10',
                                'allowLogin' => '1',
                                'allowRegistration' => '1',
                                'useGravatars' => '1',
                                'deleteOwnDiscussions' => '1',
                                'editOwnDiscussions' => '1',
                                'deleteOwnPosts' => '1',
                                'editOwnPosts' => '1',
                                'canStickyDiscussions' => '1',
                                'canCloseDiscussions' => '1',
                                'canReportDiscussions' => '1',
                                'modsDeleteDiscussions' => '1',
                                'modsEditDiscussions' => '1',
                                'modsDeletePosts' => '1',
                                'modsEditPosts' => '1',
                                'modsStickyDiscussions' => '1',
                                'modsCloseDiscussions' => '1',
                                'modsReportDiscussions' => '1',
                                'siteEnabled' => '1',
                                'allowEmailActivation' => '1',
                                'siteWelcomeMessage' => 'Welcome to '.$install_info['site_name'].' discussion forums, please feel free to have a look around or register to get involved.',
                                'adminTheme' => 'admin',
                                'siteVersion' => '1.0.3',
                                'forumInstalled' => '1',
                                'blogInstalled' => '0',
                                'blogTheme' => 'blog',
                                'forumsLayout' => 'forums',
                            );
                            
                            $this->db->set($settings_data);
                            if($this->db->insert('settings'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $activity_data = array(
                                'username' => $install_info['admin_username'],
                                'date' => time(),
                                'activity' => 'registered',
                            );
                            
                            $this->db->set($activity_data);
                            if($this->db->insert('activity'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $category_data = array(
                                'CategoryID' => '1',
                                'parentID' => '0',
                                'type' => 'forums',
                                'Name' => 'Example Category',
                                'Description' => 'This is just a example category, you can edit it in your admin panel',
                                'Active' => '1',
                            );
                            
                            $this->db->set($category_data);
                            if($this->db->insert('category'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $topic_uniqid = uniqid();
                            $topics_data = array(
                                'TopicID' => $topic_uniqid,
                                'TopicName' => 'Welcome to Dove Forums',
                                'CreatedBy' => $install_info['admin_username'],
                                'LastPost' => $install_info['admin_username'],
                                'CategoryID' => '1',
                                'CreatedTime' => time(),
                                'LastPostTime' => time(),
                                'Active' => '1',
                                'Sticky' => '1',
                                'Closed' => '0',
                                'Flagged' => '0',
                            );
                            
                            $this->db->set($topics_data);
                            if($this->db->insert('topics'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $comment_uniqid = uniqid();
                            $comments_data = array(
                                'CommentID' => $comment_uniqid,
                                'TopicID' => $topic_uniqid,
                                'CategoryID' => '1',
                                'Title' => 'Welcome to Dove Forums',
                                'Body' => 'Thank you for downloading Dove Forums. This is just an example topic and it can be removed via your admin panel.',
                                'CreatedBy' => $install_info['admin_username'],
                                'PostTime' => time(),
                                'Active' => '1',
                                'reported' => '0',
                            );
                            
                            $this->db->set($comments_data);
                            if($this->db->insert('comments'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $groups_data = array(
                                array(
                                    'id' => '1',
                                    'name' => 'admin',
                                    'description' => 'Admin has permission to do anything',
                                ),
                                
                                array(
                                    'id' => '2',
                                    'name' => 'members',
                                    'description' => 'Standard user group.',
                                ),
                                
                                array(
                                    'id' => '3',
                                    'name' => 'moderators',
                                    'description' => 'Moderators have different permissions to administrators.',
                                ),
                            );
                            
                            if($this->db->insert_batch('groups', $groups_data))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $meta_data = array(
                                'id' => '1',
                                'user_id' => '1',
                                'first_name' => '',
                                'last_name' => '',
                                'location' => '',
                                'interests' => '',
                                'occupation' => '',
                                'gender' => '',
                            );
                            
                            $this->db->set($meta_data);
                            if($this->db->insert('meta'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $theme_data = array(
                                'themeID' => '1',
                                'themeName' => 'default',
                                'themeLayout' => 'default',
                                'themeDescription' => 'Dove Lite is the standard theme that comes with Dove Forums',
                                'themeAuthor' => 'Chris Baines',
                                'themeActive' => '1',
                            );
                            
                            $this->db->set($theme_data);
                            if($this->db->insert('themes'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                            
                            $users_data = array(
                                'id' => '1',
                                'group_id' => '1',
                                'username' => $install_info['admin_username'],
                                'password' => $install_info['admin_password'],
                                'email' => $install_info['admin_email'],
                                'created_on' => time(),
                                'last_login' => time(),
                                'active' => '1',
                            );
                            
                            $this->db->set($users_data);
                            if($this->db->insert('users'))
                            {
                                $insert[] = true;
                            }else{
                                $insert[] = false;
                            }
                
                    if($insert == true)
                    {
                        // The installer has finished build the page and tell the user
                  		$data = array();
            				
    		           
            		    $page = '/installer/finished';
            		    $title = 'Dove Forums - Installer - Finished';
           		        $this->admin_page_construct($page, $title, $data);
                    }else{
                        // The installer must have failed, let the user know 
                        
                    }
                */
				
				}
				
					$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					$data['success_message'] = $this->session->flashdata('message');
					$data['title'] = 'Step 3 - Site Configuration';
        			$this->load->view('step3', $data);
				
                break;
				
				/* case '4':
				
				//validate form input
					$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
					$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
					$this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean|min_length[8]|max_length[16]');
					$this->form_validation->set_rules('company', 'Company', 'required|xss_clean');
					$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
					$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');
						
					if ($this->form_validation->run() == true)
					{
						$this->session->set_flashdata('success_message', 'You have Successfully Installed Stock Manager Advance.');
						redirect("module=installer&view=setup&step=5", 'refresh');
					}
				
					$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					$data['success_message'] = $this->session->flashdata('message');
					$data['title'] = 'Step 4 - Add Owner Account';
        			$this->load->view('step4', $data);
					
				break;	*/
                
                
                default:
            		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
					$data['title'] = 'Purchase Validation';
        			$this->load->view('validate', $data);
                break;
       }
	}
	
	public function done() {
        		
		$this->load->library('session');
		        	
		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$data['success_message'] = $this->session->flashdata('message');
      	$data['title'] = 'Installation Completed';
      	$this->load->view('done', $data);
       	
	}
    
    public function run_install()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('db_host', 'Database Host', 'trim|required');
        $this->form_validation->set_rules('db_name', 'Database Name', 'trim|required');
        $this->form_validation->set_rules('db_user', 'Database Username', 'trim|required');
        $this->form_validation->set_rules('db_password', 'Database Password', 'trim|required');
        $this->form_validation->set_rules('site_name', 'Site Name', 'required');
        $this->form_validation->set_rules('admin_username', 'Admin Username', 'required');
        $this->form_validation->set_rules('admin_email', 'Admin Email', 'required');
        $this->form_validation->set_rules('admin_password', 'Admin Password', 'required');
        $this->form_validation->set_rules('admin_confirm', 'Confirm Password', 'required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->setup('step1');
        }
        else
        {
            $db_host = trim($this->input->post('db_host'));
            $db_name = trim($this->input->post('db_name'));
            $db_user = trim($this->input->post('db_user'));
            $db_password = $this->input->post('db_password');
            
            $salt = $this->store_salt ? $this->salt() : FALSE;
            $password = $this->input->post('admin_password');
            $new_password = $this->hash_password($password, $salt);
            
            // Build the data for the next step of the install
            $data = array(
                'db_host' => $this->input->post('db_host'),
                'db_user' => $this->input->post('db_user'),
                'db_password' => $this->input->post('db_password'),
                'site_name' => $this->input->post('site_name'),
                'admin_username' => $this->input->post('admin_username'),
                'admin_email' => $this->input->post('admin_email'),
                'admin_password' => $new_password,
            );
            
            $link = mysql_connect($db_host, $db_user, $db_password);
            if(!$link)
            {
                $db_connection = false;
            }else{
                $query = 'CREATE DATABASE '.$this->input->post('db_name').'';
                mysql_query($query);
				$db_connection = true;
            }
            
            if($db_name)
            {
                $dbcheck = mysql_select_db($db_name);
                if(!$dbcheck)
                {
                    $db_check = false;
                }else{
                    $db_check = true;
                }
            }
            
            if($db_connection == true)
            {
                // All checks passed lets proceed
                    
                // Build a array of files we need to chmod
                $files = array();
                $files['config_file'] = 'config.php';
                $files['database_file'] = 'database.php';
                $files['ion_auth_file'] = 'ion_auth.php';
                  
                // Load all the mask files and set the output file for each.
                $config_mask = ''.getcwd().'/application/modules/installer/views/installer/masks/config_temp.php';
                $config_output = ''.getcwd().'/application/config/config.php';
                $database_mask = ''.getcwd().'/application/modules/installer/views/installer/masks/database_temp.php';
                $database_output = ''.getcwd().'/application/config/database.php';
                $autoload_mask = ''.getcwd().'/application/modules/installer/views/installer/masks/autoload_temp.php';
                $autoload_output = ''.getcwd().'/application/config/autoload.php';
                $routes_mask = ''.getcwd().'/application/modules/installer/views/installer/masks/routes_temp.php';
                $routes_output = ''.getcwd().'/application/config/routes.php';
                $ion_auth_mask = ''.getcwd().'/application/modules/installer/views/installer/masks/ion_auth_temp.php';
                $ion_auth_output = ''.getcwd().'/application/config/ion_auth.php';
                        
                // Get contents of mask files
                $config_file = file_get_contents($config_mask);
                $database_file = file_get_contents($database_mask);
                $autoload_file = file_get_contents($autoload_mask);
                $routes_file = file_get_contents($routes_mask);
                $ion_auth_file = file_get_contents($ion_auth_mask);
                        
                // Replace the values in mask files
                $config_new = str_replace('%BASEURL%', $this->input->post('install_location'), $config_file);
                $database_new = str_replace('%DBHOST%', $this->input->post('db_host'), $database_file);
                $database_new = str_replace('%DBUSERNAME%', $this->input->post('db_user'), $database_new);
                $database_new = str_replace('%DBPASSWORD%', $this->input->post('db_password'), $database_new);
                $database_new = str_replace('%DBNAME%', $this->input->post('db_name'), $database_new);
                $database_new = str_replace('%DBPREFIX%', $this->input->post('db_prefix'), $database_new);
                $ion_auth_new = str_replace('%SITETITLE%', $this->input->post('site_name'), $ion_auth_file);
                $ion_auth_new = str_replace('%ADMINEMAIL%', $this->input->post('admin_email'), $ion_auth_new);
                $autoload_new = str_replace("%LIBRARIES%", "'template', 'session', 'pagination', 'table', 'timeword', 'ion_auth', 'form_validation'", $autoload_file);
                $autoload_new = str_replace("%LANGUAGE%", "'ion_auth'", $autoload_new);
                $autoload_new = str_replace("%MODEL%", "'ion_auth_model'", $autoload_new);
                $routes_new = str_replace('%ROUTE%', 'core', $routes_file);
                    
                @chmod($config_output, 0777);
                @chmod($database_output, 0777);
                @chmod($autoload_output, 0777);
                @chmod($routes_output, 0777);
                @chmod($ion_auth_output, 0777);
                     
                // Write the files 
                $config_handle = fopen($config_output,'w+');
                $database_handle = fopen($database_output, 'w+');
                $autoload_handle = fopen($autoload_output, 'w+');
                $routes_handle = fopen($routes_output, 'w+');
                $ion_auth_handle = fopen($ion_auth_output, 'w+');
                        
                @chmod($config_output, 0777);
                @chmod($database_output, 0777);
                @chmod($autoload_output, 0777);
                @chmod($routes_output, 0777);
                @chmod($ion_auth_output, 0777);
                    
                // Perfom file checks    
                if(is_writable($config_output))
                {
                    // Save the file
                    if(fwrite($config_handle, $config_new))
                    {
                        $result[] = true;
                    }else{
                        $result[] = false;
                    }
                }
                   
                if(is_writable($database_output))
                {
                    if(fwrite($database_handle, $database_new))
                    {
                        $result[] = true;
                    }else{
                        $result[] = false;
                    }
                }
                    
                if(is_writable($autoload_output))
                {
                    if(fwrite($autoload_handle, $autoload_new))
                    {
                        $result[] = true;
                    }else{
                        $result[] = false;
                    }
                }
                   
                if(is_writable($routes_output))
                {
                    if(fwrite($routes_handle, $routes_new))
                    {
                        $result[] = true;
                    }else{
                        $result[] = false;
                    }
                }
                 
                if(is_writable($ion_auth_output))
                {
                    if(fwrite($ion_auth_handle, $ion_auth_new))
                    {
                        $result[] = true;
                    }else{
                        $result[] = false;
                    }
                }
                        
                if($result == true)
                {    		
                    $this->session->set_userdata('install_info', $data);
            		redirect('installer/setup/step3', 'refresh');
                }
                
            }else{
                echo 'checks failed<br>';
                echo mysql_error();
            }
        }
    }
    
}