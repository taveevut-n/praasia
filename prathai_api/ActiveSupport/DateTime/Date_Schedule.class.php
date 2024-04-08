<?php

/*
    PHP_Scheduler
    Version 0.5.1
    Ryan Flynn (ryan@ryanflynn || DALnet->#php->pizza_milkshake)
    Saturday, June 24 2001
    
    This class was written to solve the problem of a standardized scheduling/timing mechanism 
    in PHP that needed to be cross-OS compatible. For the moment it's nothing more than a simple
    timer, but I hope to build it into a cross-platform crontab-like class. We'll see.
    This class has been tested with PHP 4.0.x on Windows 2000/IIS and FreeBSD 4.2/Apache.
    
    Uses for this class would be along the lines of:
    
        "I need to update a file not more than every 15 minutes"
        "I want to cache my qery results to increase performance but refresh every 30 minutes"
    
    =================================================================================
    
    An example of the use of this class:
    
    //this script shows the # of registered users
    
    $sch=new Scheduler("news");         //create new sched obj
    $sch->set_increment("MINUTES", 30); //set to 30 minute increments
    $sch->start();                      //put in motion - this will only actually 'start' the 
                                        //counter if this is the first "news" Scheduler created,
                                        //otherwise it will leave the existing "news" time alone
    
        if($sch->times_up()){           //if it's been 30 or more minites since
                                        //last access to DB we get fresh results
            $rs=mysql_query("SELECT COUNT(*) AS users FROM tbl_users;");    //no error checking, sloppy!
            $rs2=mysql_fetch_array($rs);
            putenv("TOTAL_REGGED_USERS={$rs2[0]}");
        }
    
    echo getenv("TOTAL_REGGED_USERS");
    
    $sch->cleanup(); //kills object but not global var (so next pageview can access it)
    
    =================================================================================
    
    WARNING: This may seem obvious, but you need to use diffnt strings to declare diffnt scheduler
    objects, i.e. if you have two pages using two diffn't scheds you cannot use the same string
    or it over-writes the other object's time.
    
    I absolutely encourage feedback and/or modification of this class to improve it. I'm
    much less worried about my ego than I am about providing others with a useful utility.
*/

    class Scheduler{
        var $increment;
        var $inc_value=0;
        
        var $inc_array = array('SECONDS'=>1, 'MINUTES'=>60, 'HOURS'=>3600);
        var $env_name;
        var $name;
        
        //exteriors
        
            function Scheduler($name){
                $this->env_name = "PHP_SCHEDULER_{$name}";
            }
            
            function set_increment($a_inc='SECONDS', $a_incval=0){
                if($a_incval > 0)
                    $this->inc_value=$a_incval;
                
                if(!$this->within_array($a_inc, $this->inc_array)){
                    $this->increment='SECONDS';
                }else{
                    $this->increment=$a_inc;
                }
            }
            
            function start(){
                if($this->times_up() || !strlen($this->read_time()))
                    $this->write_time();
            }
            
            function times_up(){
                    if($this->inc_value < 1)
                        return true;
                
                $diff = doubleval(time()-$this->read_time());
                
                    if(floor($diff/$this->inc_array[$this->increment]) >= $this->inc_value){
                        return true;
                    }else{
                        return false;
                    }
            }
            
            function update_time(){
                $this->write_time();
            }
            
            function clear(){
                putenv($this->env_name."=''");
            }
            
            function cleanup(){
                unset($this);
            }
            
        //interior
            
            function read_time(){
                return getenv($this->env_name);
            }
            
            function write_time(){
                 putenv($this->env_name."=".time());
            }
            
        //supporting
            
            function within_array($item, $array){
                for($lupe=0; $lupe<sizeof($array); $lupe++){
                    if(strcmp($item, $array[$lupe])==0)
                        return true;
                }
                return false;
            }
        
    }
?>