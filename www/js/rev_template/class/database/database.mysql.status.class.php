<?php
##
## this file name is 'class.mysql.status.php'
##
## show mysql my database status,
## mysql server status, server variables and comments
##
## [author]
##  - Chilbong Kim, <san2(at)linuxchannel.net>
##  - http://linuxchannel.net/
##
## [changes]
##  - 2004.06.17 : support FreeBSD and MySQL4.0.20
##  - 2003.08.28 : associative array tunning
##  - 2003.08.11 : fixed, CRITICAL_LIFE_TIME
##  - 2003.08.07 : fixed, div zero
##  - 2003.08.05 : add each get mode, see ex9)
##  - 2003.07.06 : add more server status and variables(extended comments) 
##  - 2003.07.03 : add others database status(if available)
##  - 2003.01.26 : bug fixed, and upgraded comments, support MySQL 4.0.x
##  - 2003.01.24 : add status of [Threads_cached]
##  - 2003.01.23 : fixed errata
##  - 2003.01.20 : add parsing to HTML
##  - 2003.01.19 : add comments
##  - 2003.01.10 : get mydb, status, vars
##
## [references]
##  - http://www.mysql.com/doc/en/SHOW_TABLE_STATUS.html
##  - http://www.mysql.com/doc/en/SHOW_STATUS.html
##  - http://www.mysql.com/doc/en/SHOW_VARIABLES.html
##  - http://www.mysql.com/information/presentations/presentation-oscon2000-20000719/
##  - http://www.mysql.com/doc/en/MySQL_Optimisation.html
##
## [download]
##  - http://ftp.linuxchannel.net/devel/php_mysql_status/
##  - download 'class.mysql.status.php.txt' file and rename to class.mysql.status.php
##
## [special] example
##  a special user 'status' addition
##  - MySQL 3.23.x
##    mysql> GRANT SELECT ON *.* TO status@yourhost IDENTIFIED BY 'yourepassword';
##  - MySQL 4.0.3 over
##    mysql> GRANT SELECT, SHOW DATABASES ON *.* TO status@yourhost IDENTIFIED BY 'yourepassword';
##  - or
##    mysql> UPDATE mysql.db SET Db = '%' WHERE User = 'status';
##
## [usage]
##  usage : object mysql_status[( [int what [, mixed db [, bool detail]]] )]
##    object->tohtml();
##
##  ex1) all status view(exclude all databases and detail view)
##    $status = new mysql_status; // default $what 7
##    $status->tohtml();
##
##  ex2) only my database status view
##    $status = new mysql_status(1); // or mysql_status(1,'mydb_name')
##    $status->tohtml();
##
##  ex3) only my database and others databases summary status view
##    $status = new mysql_status(1,array('foo','bar'));
##    $status->tohtml();
##
##  ex4) only my database and all databases detail status view
##    $status = new mysql_status(1,-1,1);
##    $status->tohtml();
##
##  ex5) only server status view
##    $status = new mysql_status(2);
##    $status->tohtml();
##
##  ex6) my database and server status view
##    $status = new mysql_status(3);
##    $status->tohtml();
##
##  ex7) only server variables view
##    $status = new mysql_status(4);
##    $status->tohtml();
##
##  ex8) HTML handle : see arguments of tohtml() function
##    $status = new mysql_status;
##    // '#000000' default, is line color of HTML table
##    // '#CCCCCC' default, is head color of HTML table
##    // '#FFFFFF' default, is TD color of HTML table
##    $color = array('line'=>'#000000','th'=>'#CCCCCC','td'=>'#FFFFFF');
##    $status->tohtml($color); // is defaults
##    or
##    $status->color = array(...);
##    $status->tohtml();
##
##  ex9) each print by $this->color
##    $status = & new mysql_status;
##
##    $status->what = 1; for databases
##    $status->db = -1; // all databases
##    $status->detail = TRUE; // detail view
##    $status->color = array(...);
##    $status->tohtml(); // print all databases
##
##    $status->what = 6; // 2 + 4
##    $status->color = array(...); // or $status->color[td] = '#XXXXXX';
##    $status->tohtml();
##
##  ex10) constants type of $what
##    $status->what = _MYDB_;    // same as $what = 1
##    or
##    $status->what = _STAT_;    // same as $what = 2
##    or
##    $status->what = _VARS_;    // same as $what = 4
##    or
##    $status->what = _STAT_ + _VARS_; // same as $what = 6
##
##  and, more see $this->what argument of mysql_status() function,
##  also see $this->color arguments of tohtml() function
##

class mysql_status
{
  var $version = 20040617; // this version

  ## arguments, for detail print option
  ##
  var $what    = 0;        // integer, get mode(1 <= $what <= 7)
  var $db    = '';        // mixed, target database(s)
  var $detail    = FALSE;    // boolean, show detail others databases
  var $link    = '';        // resource link

  ## html color setting and check _get()
  ##
  var $color    = array
        (
        'line' => '#000000', // line color of HTML table
        'th'   => '#CCCCCC', // head color of HTML table
        'td'   => '#FFFFFF', // TD color of HTML table
        );
  var $_get    = FALSE;    // check _get(), don't this change
  var $bits    = '0';        // string, bits of print mode(000 ~ 111)

  ## basic, for table status from databases
  ##
  var $host    = '';        // string, MySQL server name or ip-addr
  var $via    = '';        // string, C/S connection method(SOCKET or TCP/IP)
  var $cdb    = '';        // string, current connected database name
  var $dbs    = '';        // string, number of databases
  var $databases= array();    // array, lists of databases name

  ## databases infomation
  ##
  var $mydb    = array();    // array, mydb(current database) information
  var $odb    = array();    // array, others database information
  var $dbsum    = array();    // array, simple database summary

  ## server status or variables infomation
  ##
  var $stat    = array();    // array, MySQL server status
  var $vars    = array();    // array, MySQL server variables
  var $comments    = array();    // array, MySQL server status comments

  ## get mysql mydb status and server variables and status
  ##
  ## usage :
  ##    object mysql_status[( [int what [, mixed db [, bool detail]]] )]
  ##    
  ## arguments :
  ##    $what    integer(0 <= $what <= 7), bits of get mode
  ##        - default : $what 7
  ##        - $what 0 : all, same as $what 7
  ##        - $what 1 : _MYDB_, only my database(include $db) infomation
  ##        - $what 2 : _STAT_, only server status
  ##        - $what 3 : $what 1 + $what 2
  ##        - $what 4 : _VARS_, only server variables
  ##        - $what 5 : $what 1 + $what 4
  ##        - $what 6 : $what 2 + $what 4
  ##        - $what 7 : all, $what 1 + $waht 2 + $what 4
  ##
  ##    $db    mixed, if bit($what) 1 exists, table status of $db
  ##        - $db false         : boolean, default current connected database
  ##        - $db array()         : array, same as above
  ##        - $db 0             : integer|string, same as above
  ##        - $db ''         : string, same as above
  ##        - $db 'foo'         : string, only 'foo' database
  ##        - $db 'foo,bar,some'     : string, three databases(foo and bar and some)
  ##        - $db array('foo')     : array, same as above
  ##        - $db array('foo','bar') : array, 'foo' and 'bar' databases
  ##        - $db -1         : integer, all databases(if available)
  ##
  ##    $detail boolean, if bit($what) 1 and $db exists, $db detail view, default false
  ##
  function mysql_status($what=0, $db='', $detail=FALSE, $link='')
  {
    $this->what = (int)$what;
    $this->db = $db;
    $this->detail = (boolean)$detail; // boolean
    $this->get_host_info(); // host and connection method

    define('_MYDB_',1);
    define('_STAT_',2);
    define('_VARS_',4);
  }

  ## get mydb, status, vars
  ##
  function _get()
  {
    ## set to TRUE this _get()
    ##
    $this->_get = TRUE;

    ## check $what
    ##
    $what = (int)$this->what;
    if($what<1 || $what>7) $this->what = 7;

    $bits = $this->bits = $this->get_bits($this->what);

    ## get mydb or others databases status
    ##
    if($bits[0])
    {
        ## $sql = 'SELECT DATABASE()'
        ##
        $this->get_cdb();

        ## $sql = 'SHOW DATABASES', same as 'mysqlshow [OPTIONS]' or mysql_list_dbs()
        ##
        $this->get_dbs();

        ## $sql = 'SHOW TABLE STATUS', same as 'mysqlshow [OPTIONS] --status mydb'
        ##
        $this->get_mydb();

        ## others database information
        ##
        $this->get_odb($this->db);
    }

    ## $sql = 'SHOW STATUS', same as 'mysqladmin [OPTIONS] extended-status'
    ##
    if($bits[1]) $stat = $this->get_array('SHOW STATUS');

    ## $sql = 'SHOW VARIABLES', same as 'mysqladmin [OPTIONS] variables'
    ##
    if($bits[2]) $vars = $this->get_array('SHOW VARIABLES');

    ## then, get main server status
    ##
    if($bits[1])
    {
        if(!$bits[0]) $this->get_dbs(); // number of databases

        ## get comments from $vars, $stat
        ##
        $stat = $this->get_comments($vars,$stat);

        ## then, get main server status
        ##
        $this->get_stat($stat);
    }

    ## and then, get main server variables
    ##
    if($bits[2]) $this->get_vars($vars);

    ## force to flush buffer
    ##
    unset($vars);
    unset($stat);
  }

  ## decimal to binary
  ##
  function get_bits($dec)
  {
    if(!is_int($dec)) return 0;

    $dec = abs($dec);
    $bits = strrev(decbin($dec));

    return $bits; // is not integer, is string
  }

  ## get host and via information
  ##
  function get_host_info($link='')
  {
    $info = mysql_get_host_info();
    list($this->host,$this->via) = preg_split(';\s+via\s+;',$info);
    unset($info);
  }

  ## get current connected database name(if available)
  ##
  function get_cdb()
  {
    $sql = 'SELECT DATABASE()';
    if(!$result = @mysql_query($sql)) return;

    $this->cdb = mysql_result($result,0,0);
    mysql_free_result($result);
  }

  ## get databases list
  ##
  function get_dbs()
  {
    $result = @mysql_list_dbs(); // 'SHOW DATABASES' same as 'mysqlshow [OPTIONS]'
    $nums = @mysql_num_rows($result) + 0;

    if($nums < 2)
    {
        $this->dbs = 'hidden';
        $databases = array(); // this false
    } else
    {
        $this->dbs = $nums .' or more';
        while($list = @mysql_fetch_row($result))
        { $databases[] = $list[0]; }
    }

    @mysql_free_result($result);

    if($databases && $this->cdb)
    {
        $databases = array_diff($databases,array($this->cdb));
        $this->databases = array_values($databases); // resort by numberic
    }
  }

  ## get my database infomation
  ##
  function get_mydb()
  {
    $this->mydb = $this->get_db_array($this->cdb);
  }

  ## get others database infomation
  ##
  function get_odb($db)
  {
    if($db)
    {
        if(is_array($db))
        { $odb = array_values($db); } // sort by numberic

        else if($db == '-1') // all databases, if available
        { $odb = &$this->databases; } // array, use reference

        else
        { $odb = preg_split('/\s*,\s*/',preg_replace('/[,]+$/','',trim($db))); }
    }

    $size = sizeof($odb);
    for($i=0; $i<$size; $i++)
    { $this->odb[$odb[$i]] = $this->get_db_array($odb[$i]); }

    if(!$this->detail) unset($this->odb);
  }

  ## get array of table status from $db
  ##
  ## http://www.mysql.com/doc/en/SHOW_TABLE_STATUS.html
  ##
  function get_db_array($db='')
  {
    if($db) $sql = ' FROM '.$db;
    if(!$result = @mysql_query('SHOW TABLE STATUS'.$sql)) return;

    $i = 0;
    while($lists = mysql_fetch_assoc($result)) // associative array
    {
        $array[] = array
        (
        'name' => $lists['Name'],
        'type' => $lists['Type'],
        'rows' => number_format($lists['Rows']),
        'srow' => $this->hsize($lists['Avg_row_length']), // size of avg row
        'size' => $this->hsize($lists['Data_length']), // size of this table
        'sidx' => $this->hsize($lists['Index_length'])
        );

        $sum['rows'] += $lists['Rows'];
        $sum['size'] += $lists['Data_length'];
        $sum['sidx'] += $lists['Index_length'];

        $i++;
    }

    mysql_free_result($result);

    $this->dbsum[] = $array[] = array
    (
    'name' => '<B>'.$db.'</B>',
    'type' => $i.' tables',
    'rows' => number_format($sum['rows']),
    'srow' => $this->hsize(@round($sum['size']/$sum['rows'])),
    'size' => '<B>'.$this->hsize($sum['size']).'</B>',
    'sidx' => $this->hsize($sum['sidx'])
    );

    return $array;
  }

  ## get MySQL server status and variables
  ##
  ## http://www.mysql.com/doc/en/SHOW_STATUS.html
  ## http://www.mysql.com/doc/en/SHOW_VARIABLES.html
  ## http://www.mysql.com/information/presentations/presentation-oscon2000-20000719/
  ##
  function get_array($sql)
  {
    if(!$result = mysql_query($sql)) return;

    ## get array to $vars
    ##
    while($lists = mysql_fetch_row($result))
    { $array[$lists[0]] = $lists[1]; }

    mysql_free_result($result);

    return $array;
  }

  ## get comments and return $stat(added)
  ##
  ## 1) MySQL caches(all threads shared) [***]
  ##    - key_buffer_size    : 8MB < INDEX key
  ##    - table_cache        : 64 < number of open tables for all threads
  ##    - thread_cache_size    : 0 < number of keep in a cache for reuse
  ##
  ## 2) MySQL buffers(not shared) [***]
  ##    - join_buffer_size    : 1MB < FULL-JOIN
  ##    - myisam_sort_buffer_size : 8MB < REPAIR, ALTER, LOAD
  ##    - record_buffer        : 2MB < sequential scan allocates
  ##    - record_rnd_buffer    : 2MB < ORDER BY(to avoid a disk seeks)
  ##    - sort_buffer        : 2MB < ORDER BY, GROUP BY
  ##    - tmp_table_size    : 32MB < advanced GROUP BY(to avoid a disk seeks)
  ##
  ## 3) MySQL memory size of INDEX(key)/JOIN/RECORD(read)/SORT/TABLE
  ##    - INDEX(key)        : 8MB < [***] key_buffer_size (shared)
  ##    - JOIN             : 1MB <    [***] join_buffer_size (not shared)
  ##    - RECORD(read)        : 2MB < [***] record_buffer (not shared)
  ##                : 2MB < [***] record_rnd_buffer (not shared)
  ##    - SORT            : 8MB < [   ] myisam_sort_buffer_size (not shared)
  ##                : 2MB <    [***] sort_buffer (not shared)
  ##    - TABLE(tmp)        : 32MB< [***] tmp_table_size(not shared)
  ##
  ## 4) MySQL timeout
  ##    - connect_timeout    : 5 > bad handshake timeout
  ##    - interactive_timeout    : 28800 > active to re-active timeout
  ##    - wait_timeout        : 28000 > not active to active timeout
  ##
  ## 5) MySQL connections
  ##    - max_connections    : 100 < 'to many connections' error
  ##    - max_user_connections    : 0(no limit) or upto [Max_used_connect] status
  ##
  function get_comments($vars, $stat)
  {
    global $_SERVER; // for PHP/4.0.x

    $stat['ab_clients'] =
        sprintf('%.2f',$stat['Aborted_clients']*100/$stat['Connections']);
    $stat['ab_connects'] =
        sprintf('%.2f',$stat['Aborted_connects']*100/$stat['Connections']);

    $stat['per_qs'] = sprintf('%.2f',$stat['Questions']/$stat['Uptime']);
    $stat['per_qc'] = sprintf('%.2f',$stat['Questions']/$stat['Connections']);
    $stat['per_cs'] = sprintf('%.2f',$stat['Connections']/$stat['Uptime']);
    $stat['per_kr'] = sprintf('%.2f',@($stat['Key_reads']/$stat['Key_read_requests']));
    $stat['per_kw'] = sprintf('%.2f',@($stat['Key_writes']/$stat['Key_write_requests']));
    $stat['per_tc'] = sprintf('%.2f',$stat['Threads_created']/$stat['Connections']);
    $stat['per_oc'] = sprintf('%.2f',$stat['Opened_tables']/$stat['Connections']);
    $stat['per_ic'] = sprintf('%.3f',$stat['Uptime']/$stat['Connections']);
    $stat['per_iq'] = sprintf('%.3f',$stat['Uptime']/$stat['Questions']);
    $stat['per_pd'] = sprintf('%.2f',$stat['Com_delete']*100/$stat['Questions']);
    $stat['per_pi'] = sprintf('%.2f',$stat['Com_insert']*100/$stat['Questions']);
    $stat['per_ps'] = sprintf('%.2f',$stat['Com_select']*100/$stat['Questions']);
    $stat['per_pu'] = sprintf('%.2f',$stat['Com_update']*100/$stat['Questions']);
    $stat['per_pr'] = sprintf('%.2f',$stat['Com_replace']*100/$stat['Questions']);
    $stat['per_pl'] = sprintf('%.2f',$stat['Com_lock_tables']*100/$stat['Questions']);
    $stat['per_td'] = sprintf('%.2f',
        @($stat['Created_tmp_disk_tables']*100/$stat['Created_tmp_tables']));
    $stat['per_rs'] = sprintf('%.2f',$stat['Bytes_sent']/$stat['Bytes_received']);
    $stat['tcs'] = ceil($stat['per_cs']);

    if($stat['Max_used_connections'] > 0)
    {
        $stat['life_time'] =
            ceil((@($stat['Max_used_connections']*$stat['per_ic'])+1)/2);
        $stat['wto'] =
            ceil($stat['life_time']-@($stat['life_time']/$stat['per_qc']));
        $stat['life_time_str'] = number_format($stat['life_time']);
        $stat['wto_str'] = number_format($stat['wto']);
    } else
    {
        $stat['life_time_str'] = $stat['wto_str'] = 'NA';
    }

    ## share refer vars
    ##
    if($vars)
    {
        $stat['life_time_max'] =
            ceil((@($vars['max_connections']*$stat['per_ic'])+1)/2);
        $stat['wto_max'] =
            ceil($stat['life_time_max'] -
            @($stat['life_time_max']/$stat['per_qc']));
        $stat['life_time_max_str'] =
            number_format($stat['life_time_max']);
        $stat['wto_max_str'] =
            number_format($stat['wto_max']);

        $stat['refer_vars_wait_timeout'] =
            number_format($vars['wait_timeout']).
            '('.$this->runtime($vars['wait_timeout']).')';
        $stat['refer_vars_interactive_timeout'] =
            number_format($vars['interactive_timeout']).
            '('.$this->runtime($vars['interactive_timeout']).')';
        $stat['refer_vars_connect_timeout'] =
            number_format($vars['connect_timeout']).
            '('.$this->runtime($vars['connect_timeout']).')';
        $stat['refer_vars_key_buffer_size'] =
            number_format($vars['key_buffer_size']).
            '('.$this->hsize($vars['key_buffer_size']).')';
        $stat['refer_vars_max_connections'] =
            number_format($vars['max_connections']);
        $stat['refer_vars_table_cache'] =
            number_format($vars['table_cache']);
        $stat['refer_vars_thread_cache_size'] =
            number_format($vars['thread_cache_size']);
        $stat['refer_vars_tmp_table_size'] =
            number_format($vars['tmp_table_size']).
            '('.$this->hsize($vars['tmp_table_size']).')';
        $stat['refer_vars_long_query_time'] =
            number_format($vars['long_query_time']).
            '('.$this->runtime($vars['long_query_time']).')';
    }

    $B['b'] = '<FONT COLOR=#0000FF>';    // blue color, for ok
    $B['r'] = '<FONT COLOR=#FF0000>';    // red color, for warning
    $B['n'] = '<FONT COLOR=#990000>';    // brown, form notice
    $B['e'] = '</FONT>';

    $busy = array('normal','some busy','very busy','hot busy');
    $ok = $B['b'].', ����'.$B['e'];
    $rep = $B['n'].',<BR>Replication(�̷���)����� ������� �ʴ´ٸ� '.
        '�� ����� OFF �ϼ���.'.$B['e'];
    $tc = '<A HREF="http://linuxchannel.net/board/read.php?table=alpha&no=27"'.
        ' TARGET="_blank">[����]</A>';
    $wt = '<A HREF="http://linuxchannel.net/docs/mysql-timeout.txt"'.
        ' TARGET="_blank">[����]</A>';

    if($stat['per_qs'] < 1) $bkey = 0;
    else if($stat['per_qs'] < 10) $bkey = 1;
    else if($stat['per_qs'] < 20) $bkey = 2;
    else $bkey = 3;

    $this->comments['busy'] = &$busy[$bkey];
    $this->comments['wto'] = '���� ������(�߼�:'.$stat['wto_str'].
        '��, �Ӱ�:'.$stat['wto_max_str'].'��)';
    $this->comments['tcs'] = '���� ������(�ּ�:'.$stat['tcs'].
        ', ����:'.($stat['tcs']*2+1).', �ִ�:'.($stat['tcs']*3+2).')';

    if($stat['Uptime'] < 86400)
    {
        $this->comments['notice'] = $B['n'].', �����ġ'.$B['e'];
        $this->comments['poor'] = $B['n'].', ������ ����ڷᰡ �ʹ� �����ϴ�.'.$B['e'];
    }

    if($stat['ab_clients'] > 1)
    {
        $this->comments['wait_timeout'] =
        $B['r'].',<BR>���� ��Ұ� �����ϴ�(���� 1%). '.
        $stat['refer_vars_wait_timeout'].'(wait_timeout)�ʳ� '.
        $stat['refer_vars_interactive_timeout'].
        '(interactive_timeout)�ʺ��� '.
        '�ʰ� close �ϰų� ������ ���� �ʴ� ��찡 �����ϴ�.'.
        $wt.$B['e'];
    }
    else $this->comments['wait_timeout'] = $ok.$wt;

    $this->comments['interactive_timeout'] = &$this->comments['wait_timeout'];

    if($stat['ab_connects'] > 1)
    {
        $this->comments['connect_timeout'] =
        $B['r'].',<BR>�߸���(fail) ���� ��û�� �����ϴ�(���� ����)'.
        '(���� 1 %). '.$stat['refer_vars_connect_timeout'].
        '(connect_timeout)���� �� ���� ��û, Ʋ�� ��ȣ, ���� ���� ����.'.
        $B['e'];
    }
    else $this->comments['connect_timeout'] = &$ok;

    if($stat['Key_read_requests'] > 100 && $stat['per_kr'] > 0.01)
    {
        $this->comments['key_buffer_size'] = $B['r'].
        ',<BR>DISK���� Key�� �д� ��û�� �����ϴ�'.
        '(���� 0.01%). '.$stat['refer_vars_key_buffer_size'].
        '(key_buffer_size)���� �ø�����.'.$B['e'];
    }
    else $this->comments['key_buffer_size'] = &$ok;

    if($vars['log_update'] == 'ON') $this->comments['log_update'] = &$rep;
    if($vars['log_bin'] == 'ON') $this->comments['log_bin'] = &$rep;

    if($vars['max_connections'])
    {
        $max['vars'] = max($stat['Max_used_connections'],$vars['max_connections']);
        $max['stat'] = $stat['Max_used_connections'] / $vars['max_connections'];

        if($max['stat'] > 0.95 )
        {
            if($stat['wto']>5 && $vars['wait_timeout']>$stat['wto'])
            {
                $checkwto = ' ���� '.
                $this->stat['refer_vars_wait_timeout'].'[wait_timeout]�� '.
                $this->comments['wto'].'���� Ʃ���� ������';
            }

            $max['to'] = $max['vars'] + (int)($max['vars']*0.2);
            $this->comments['max_connections'] = $B['r'].
            ',<BR>�ִ� ���Ӽ��� �����ϰų� �ʰ��߽��ϴ�. '.
            $stat['refer_vars_max_connections'].
            '[max_connections]���� '.$max['to'].' ������ �ø�����.'.
            $checkwto.$B['e'];
        }
        else $this->comments['max_connections'] = &$ok;

        $max['table'] = $max['vars'] * 2;

        if($stat['Opened_tables'] > $vars['table_cache'] && $max['table'] > $vars['table_cache'])
        {
            $this->comments['table_cache'] = $B['r'].',<BR>'.
            $stat['refer_vars_table_cache'].'[table_cache]���� '.$max['table'].' ������ �ø�����.'.
            $B['e'];
        } else
        {    $this->comments['table_cache'] =
            $B['b'].', '.$stat['per_oc'].'/Connection'.$B['e'];
        }
    }

    if($vars['safe_show_database'] == 'OFF')
    {
        $this->comments['safe_show_database'] = $B['r'].',<BR>'.
        '���Ȼ� ���� �ʴ� �����Դϴ�. �� ������ ON �ϼ���'.$B['e'];
    }
    else $this->comments['safe_show_database'] = &$ok;

    if($vars['skip_external_locking']) $slm = 'external_';
    if($vars['skip_'.$slm.'locking'] == 'OFF')
    {
        $this->comments['skip_'.$slm.'locking'] = $B['n'].',<BR>'.
        '���� �� MySQL ������ �ܺ� Lock�� ����ϴ� ������ �����Ǿ� �ֽ��ϴ�. '.
        '�� �𸣰����� ON���� �����ϼ���.'.$B['e'];
    }

    if($vars['skip_networking'] == 'OFF')
    {
        if(preg_match('/TCP/',$this->via)
            && $_SERVER['SERVER_ADDR'] == @gethostbyname($this->host))
        {
            $this->comments['skip_networking'] = $B['r'].',<BR>'.
            'MySQL ������ Ŭ���̾�Ʈ�� ���� ������ IP �ּ��ӿ��� �ұ��ϰ� '.
            'TCP/IP ������ ����ϰ� �ֽ��ϴ�(��������). ������ �ٸ� ȣ��Ʈ���� '.
            '�����ϴ� ��찡 ���ٸ�, �� �ɼ��� ON ���� �����ϰ� '.
            'UNIX domain socket(localhost:'.$vars['socket'].')�� ����ϼ���.'.
            $B['e'];
        }
        else if(preg_match('/socket/',$this->via))
        {
            $this->comments['skip_networking'] = $B['n'].',<BR>'.
            '���� UNIX domain socket(:'.$vars['socket'].')�� ����ϰ� �ֽ��ϴ�. '.
            '������ �ٸ� ȣ��Ʈ���� �����ϴ� ��찡 ���ٸ� �� �ɼ��� ON���� '.
            '�����ϼ���'.$B['e'];
        }
        else $this->comments['skip_networking'] = &$ok;
    }
    else
    {
        $this->comments['skip_networking'] = $B['n'].',<BR>�ٸ� ������ ȣ��Ʈ���� '.
        '�������� ���ϵ��� ��õ����Ǿ� �ֽ��ϴ�.'.$B['e'];
    }

    if($vars['skip_show_database'] == 'ON')
    {
        $this->comments['skip_show_database'] =
        $B['n'].',<BR>�ʹ� �������� �����ΰ� �����ϴ�.'.$B['e'];
    }

    if($stat['per_tc'] > 0.01)
    {
        if($stat['per_cs'] > 1)
        {
            $this->comments['thread_cache_size'] = $B['r'].',<BR>'.
            $stat['refer_vars_thread_cache_size'].
            '[thread_cache_size]���� �ø�����.'.$tc.$B['e'];
        }
        else if($vars['thread_cache_size'] < 2)
        {
            $this->comments['thread_cache_size'] = $B['r'].',<BR>'.
            '���� ������ �ſ� �ٻ��� �����Ƿ� '.
            $stat['refer_vars_thread_cache_size'].
            '[thread_cache_size]���� Ʃ�� ������.'.$tc.$B['e'];
        }
        /***
        else
        {
            $this->comments['thread_cache_size'] = $B['r'].',<BR>'.
            '���� ������ �ſ� �ٻ��� �����Ƿ�, �ð��� ���� ������ '.
            '�� �޽����� ������ �ʾƾ� �����Դϴ�.'.$tc.$B['e'];
        }
        ***/
    }
    else $this->comments['thread_cache_size'] = $ok.$tc;

    return $stat;
  }

  ## get main status
  ##
  function get_stat($stat)
  {
    $this->stat = array
    (
    'TOTAL_STATUS' =>
        array($stat['per_qs'],
        '<B>'.$this->comments['busy'].'</B> (1�ʴ� ��� ���� ��û��)'),
    'CRITICAL_LIFE_TIME' =>
        array($stat['life_time_str'].'��',
        'Ŀ�ؼǴ� �������(�߼�) �Ӱ� life time(CUR)'),
    'CRITICAL_LIFE_TIME_MAX' =>
        array($stat['life_time_max_str'].'��',
        'Ŀ�ؼǴ� �������(�ִ�) �Ӱ� life time(EXP)'),
    'All_databases' =>
        array($this->dbs,
        '�����ͺ��̽� ��'),
    'Aborted_clients' =>
        array(number_format($stat['Aborted_clients']),
        '���� ��� Clients ��, refer '.
        $stat['refer_vars_wait_timeout'].'[wait_timeout] and '.
        $stat['refer_vars_interactive_timeout'].'[interactive_timeout]'),
    'Aborted_connects' =>
        array(number_format($stat['Aborted_connects']),
        '���� ���м�, refer '.
        $stat['refer_vars_connect_timeout'].'[connect_timeout]'),
    'Aborted_clients_percent' =>
        array($stat['ab_clients'].'%',
        '���� �����'.$this->comments['wait_timeout']),
    'Aborted_connects_percent' =>
        array($stat['ab_connects'].'%',
        '���� ������'.$this->comments['connect_timeout']),
    'Bytes_received' =>
        array($this->hsize($stat['Bytes_received']),
        '���ŷ�(��)'),
    'Bytes_sent' =>
        array($this->hsize($stat['Bytes_sent']),
        '���۷�(��)'),
    'Bytes_per_rs' =>
        array($stat['per_rs'],
        '�ް�(1) ������(x) ����, 1:x'),
    'Bytes_sent_per_sec' =>
        array($this->hsize($stat['Bytes_sent']/$stat['Uptime']),
        '���۷�(�ʴ�)'),
    'Bytes_sent_per_min' =>
        array($this->hsize($stat['Bytes_sent']*60/$stat['Uptime']),
        '���۷�(�д�)'),
    'Bytes_sent_per_hour' =>
        array($this->hsize($stat['Bytes_sent']*3600/$stat['Uptime']),
        '���۷�(�ð���)'),
    'Bytes_sent_per_day' =>
        array($this->hsize($stat['Bytes_sent']*86400/$stat['Uptime']),
        '���۷�(�Ϸ����)'.$this->comments['notice']),
    'Com_delete' =>
        array($stat['per_pd'].'%',
        'DELETE ���� �����(��ü DB ���)'),
    'Com_insert' =>
        array($stat['per_pi'].'%',
        'INSERT ���� �����(��ü DB ���)'),
    'Com_select' =>
        array($stat['per_ps'].'%',
        'SELECT ���� �����(��ü DB ���)'),
    'Com_update' =>
        array($stat['per_pu'].'%',
        'UPDATE ���� �����(��ü DB ���)'),
    'Com_replace' =>
        array($stat['per_pr'].'%',
        'REPLACE ���� �����(��ü DB ���)'),
    'Com_lock_tables' =>
        array($stat['per_pl'].'%',
        'LOCK TABLES ���� �����(��ü DB ���)'),
    'Connections' =>
        array(number_format($stat['Connections']),
        '�� connections ��'),
    'Connections_per_sec' =>
        array($stat['per_cs'],
        '�ʴ� connections ��'),
    'Created_tmp_tables' =>
        array(number_format($stat['Created_tmp_tables']),
        '�޸𸮿� ������ �ӽ� ���̺� ��'),
    'Created_tmp_disk_tables' =>
        array(number_format($stat['Created_tmp_disk_tables']),
        'DISK�� ������ �ӽ� ���̺� ��, '.
        $stat['refer_vars_tmp_table_size'].
        '[tmp_table_size]���� ���� �޸𸮸� �䱸�ϴ� SQL ������ ����� �����'),
    'Create_tmp_disk_tables_per' =>
        array($stat['per_td'].'%',
        'DISK�� ������ �ӽ� ���̺� ��� ����'),
    'Intervals_of_connection' =>
        array($stat['per_ic'],
        'Ŀ�ؼ� �ֱ�(��)'),
    'Intervals_of_question' =>
        array($stat['per_iq'],
        '���� �ֱ�(��)'),
    'Key_reads' =>
        array(number_format($stat['Key_reads']),
        'DISK���� Key ���� ��'),
    'Key_read_requests' =>
        array(number_format($stat['Key_read_requests']),
        'ĳ�ÿ��� Key �б� ��û��'),
    'Key_writes' =>
        array(number_format($stat['Key_writes']),
        'DISK�� Key�� �� ��'),
    'Key_write_requests' =>
        array(number_format($stat['Key_write_requests']),
        'ĳ�ÿ� Key ���� ��û��'),
    'Key_reads_per_request' => // to < 0.01
        array($stat['per_kr'].'%',
        'DISK���� Key�� �д� ����'.$this->comments['key_buffer_size']),
    'Key_writes_per_request' =>
        array($stat['per_kw'].'%',
        'DISK�� Key�� ���� ����, ���� 1�� ������� ����'),
    'Max_used_connections' =>
        array(number_format($stat['Max_used_connections']),
        '���ÿ� ����� �ִ밪'.$this->comments['max_connections']),
    'Open_tables' =>
        array(number_format($stat['Open_tables']),
        '���� �����ִ� Tables ��'),
    'Opened_tables' =>
        array(number_format($stat['Opened_tables']),
        '���ȴ� Tables ��, refer '.$stat['refer_vars_table_cache'].
        '[table_cache]'.$this->comments['table_cache']),
    'Questions' =>
        array(number_format($stat['Questions']),
        '������� ���� ��û��'),
    'Questions_per_connect' =>
        array($stat['per_qc'],
        'Ŀ�ؼǴ� ��� ���� ��û��'),
    'Select_full_join' =>
        array(number_format($stat['Select_full_join']),
        'Key ���� FULL-JOIN Ƚ��'),
    'Slow_queries' =>
        array(number_format($stat['Slow_queries']),
        $stat['refer_vars_long_query_time'].
        '(long_query_time)�� ���� ū ���� ��û��'),
    'Table_locks_waited' =>
        array($this->runtime($stat['Table_locks_waited']),
        'Lock wait �ѽð�'),
    'Threads_cached' =>
        array(number_format($stat['Threads_cached']),
        'ĳ�õ� �������, '.$stat['refer_vars_thread_cache_size'].
        '[thread_cache_size]���� �׻� ����'),
    'Threads_connected' =>
        array(number_format($stat['Threads_connected']),
        '���� �����ִ� Ŀ�ؼ� ��'),
    'Threads_created' =>
        array(number_format($stat['Threads_created']),
        '������� handle Ŀ�ؼǿ� ������ ������ ��'),
    'Threads_running' =>
        array(number_format($stat['Threads_running']),
        '���� �������� ������ ��(not sleeping)'),
    'Threads_created_per' =>
        array($stat['per_tc'].'%',
        'Ŀ�ؼǴ� ������ ��� ������ ��(���� 0.01%)'.
        $this->comments['thread_cache_size']),
    'Uptime' =>
        array($this->runtime($stat['Uptime']),
        '�ֱ� MySQL ���� ���� �ð�'),
    );
  }

  ## get main variables
  ##
  function get_vars($vars)
  {
    $ver = explode('.',preg_replace('/-.+$/','',$vars['version']));
    $ver[1] = sprintf('%02d',$ver[1]);
    $ver[2] = sprintf('%02d',$ver[2]);
    $ver = $ver[0].$ver[1].$ver[2];

    ## http://www.mysql.com/doc/en/Upgrading-from-3.23.html
    ## myisam_max_extra_sort_file_size, myisam_max_sort_file_size
    ##
    if($ver < 40003)
    {
        $upg = array(
        'ast'        => 1048576, // 1024*1024
        //'bulk'    => 'myisam_bulk_insert_tree_size',
        //'qtype'    => 'query_cache_startup_type',
        'rbuffer'    => 'record_buffer',
        'rndbuffer'    => 'record_rnd_buffer',
        'sbuffer'    => 'sort_buffer',
        //'warn'    => 'warnings',
        'skiplocking'    => 'skip_locking',
        );
    } else
    {
        $_v4003 = TRUE;
        $upg = array(
        'ast'        => 1,
        //'bulk'    => 'bulk_insert_buffer_size',
        //'qtype'    => 'query_cache_type',
        'rbuffer'    => 'read_buffer_size',
        'rndbuffer'    => 'read_rnd_buffer_size',
        'sbuffer'    => 'sort_buffer_size',
        //'warn'    => 'log-warnings',
        'skiplocking'    => 'skip_external_locking',
        );
    }

    $this->vars = array
    (
    'back_log' =>
        array(number_format($vars['back_log']),'man 2 listen, '.
        'net.ipv4.tcp_max_syn_backlog'),
    'connect_timeout' =>
        array(number_format($vars['connect_timeout']).
        '('.$this->runtime($vars['connect_timeout']).')',
        'bad handshake timeout(��)'.$this->comments['connect_timeout']),
    //'delayed_insert_limit',
    //'delayed_insert_timeout',
    'join_buffer_size' =>
        array(number_format($vars['join_buffer_size']).
        '('.$this->hsize($vars['join_buffer_size']).')',
        '[***] FULL-JOIN�� ���Ǵ� �޸�'),
    'key_buffer_size' =>
        array(number_format($vars['key_buffer_size']).
        '('.$this->hsize($vars['key_buffer_size']).')',
        '[***] INDEX key buffer�� ���Ǵ� �޸�, refer [Key_xxx]'.
        $this->comments['key_buffer_size']),
    'log' =>
        array($vars['log'],'�α� ��� ����'),
    'log_update' =>
        array($vars['log_update'],
        'UPDATE �α� ��� ����'.$this->comments['log_update']),
    'log_bin' =>
        array($vars['log_bin'],
        'binary �α� ��� ����'.$this->comments['log_bin']),
    'long_query_time' =>        // status(--log-slow-queries=file)
        array(number_format($vars['long_query_time']).
        '('.$this->runtime($vars['long_query_time']).')',
        'refer '.$this->stat['Slow_queries'][0].'[Slow_queries]'),
    'lower_case_table_names' =>
        array($vars['lower_case_table_names'],
        '���̺� ��ҹ��� ��������(0 ����)'),
    'max_allowed_packet' =>
        array(number_format($vars['max_allowed_packet']).
        '('.$this->hsize($vars['max_allowed_packet']).')',
        '�ִ� ����� ��Ŷ'),
    'max_connections' =>
        array(number_format($vars['max_connections']),
        '[***] �ִ� ���� ���� Ŀ�ؼ� ��, refer '.
        $this->stat['Max_used_connections'][0].'[Max_used_connections]'.
        $this->comments['max_connections']),
    'max_delayed_threads' =>
        array($vars['max_delayed_threads'],
        '�ִ� delayed ������ ��, INSERT DELAYED ������ ���õ�'),

    'max_join_size' =>
        array(number_format($vars['max_join_size']).
        '('.$this->hsize($vars['max_join_size']).')',
        'JOIN�� ���� �ִ� ũ��(�޸� �ƴ�)'),
    'max_sort_length' =>
        array(number_format($vars['max_sort_length']).
        '('.$this->hsize($vars['max_sort_length']).')',
        'TEXT, BLOB�� ���Ŀ� ���Ǵ� �ִ� ũ��'),
    'max_user_connections' =>
        array(number_format($vars['max_user_connections']),
        '�ִ� ���� user ��(0�� ���Ѿ���)'),
    /***
    'max_tmp_tables' =>    // doesn't yet do anything
        array(number_format($vars['max_tmp_tables']),
        '�ִ� �ӽ� ���̺� ��'),
    ***/
    'myisam_max_extra_sort_file_size' =>    // MBytes(4.0.3 use bytes)
        array(number_format($vars['myisam_max_extra_sort_file_size']).'('.
        $this->hsize($vars['myisam_max_extra_sort_file_size']*$upg['ast']).
        ')','���� INDEX�� ������ ���Ǵ� �ִ� �ӽ� ���� ũ��'),
    'myisam_max_sort_file_size' =>    // MBytes(4.0.3 use bytes)
        array(number_format($vars['myisam_max_sort_file_size']).'('.
        $this->hsize($vars['myisam_max_sort_file_size']*$upg['ast']).')',
        'REPAIR, ALTER, LOAD...�� INDEX�� ������� ���Ǵ� �ӽ� ���� ũ��'),
    'myisam_sort_buffer_size' =>    // [***] use REPAIR, INDEX sort
        array(number_format($vars['myisam_sort_buffer_size']).
        '('.$this->hsize($vars['myisam_sort_buffer_size']).')',
        '[***] REPAIR, INDEX, ALTER ���Ŀ� ����ϴ� �޸�'),
    'open_files_limit' =>    // error 'Too many open file files', default '0'
        array(number_format($vars['open_files_limit']),
        '���� open ���� ��(0�� ���Ѿ���)'),
    /***
    'query_buffer_size' =>    // only 3.23.x, start(init) query buffer, default '0'
        array(number_format($vars['query_buffer_size']).
        '('.$this->hsize($vars['query_buffer_size']).')',
        '�ʱ� ���� ���ۿ� �޸�(�⺻���� 0)'),
    ***/
    $upg['rbuffer'] =>
        array(number_format($vars[$upg['rbuffer']]).
        '('.$this->hsize($vars[$upg['rbuffer']]).')',
        '[***] �������� �˻��� ���Ǵ� �޸�(read_buffer_size)'),
    $upg['rndbuffer'] =>    // [***] use improve ORDER BY(to avoid a disk seeks)
        array(number_format($vars[$upg['rndbuffer']]).
        '('.$this->hsize($vars[$upg['rndbuffer']]).')',
        '[***] ORDER BY ���Ŀ� ���Ǵ� �޸�(to avoid a disk seeks)'),
    'safe_show_database' =>    // only Ver < 4.0.3
        array($vars['safe_show_database'],
        '�������� SHOW DATABASE ���� ��� ����'.
        $this->comments['safe_show_database']),
    $upg['skiplocking'] =>
        array($vars[$upg['skiplocking']],
        '�ܺ� lock �� ����Ѵٸ� OFF�� ����.'.$this->comments[$upg['skiplocking']]),
    'skip_networking' =>
        array($vars['skip_networking'],
        'TCP/IP ���� ����(ON�� UNIX domain socket, OFF�� TCP/IP ����)'.
        $this->comments['skip_networking']),
    'skip_show_database' =>
        array($vars['skip_show_database'],
        'SHOW DATABASES ���� ��� ����(ON�� ��õ����, OFF�� ��밡��)'.
        $this->comments['skip_show_database']),

    $upg['sbuffer'] =>    // [***] use ORDER BY, GROUP BY
        array(number_format($vars[$upg['sbuffer']]).
        '('.$this->hsize($vars[$upg['sbuffer']]).')',
        '[***] ORDER BY, GROUP BY ���Ŀ� ���Ǵ� �޸�'),
    'table_cache' =>    // [***] refer to [Opened_tables] status
        array(number_format($vars['table_cache']),
        '[***] �ѹ���(all thread) �� �� �ִ� ���̺� ��, refer '.
        $this->stat['Opened_tables'][0].'[Opened_tables]'),
    'thread_cache_size' =>    // [***] refer to [Connections] and [Threads_created] status
        array(number_format($vars['thread_cache_size']),
        '[***] ������ ĳ�� ���� ��, refer '.
        $this->stat['Connections'][0].'[Connections], '.
        $this->stat['Threads_created'][0].'[Threads_created], '.
        $this->comments['tcs'].$this->comments['thread_cache_size']),
    'tmp_table_size' =>    // [***] use in-memory(to disk), GROUP BY
        array(number_format($vars['tmp_table_size']).
        '('.$this->hsize($vars['tmp_table_size']).')',
        '[***] ������ GROUP BY ���Ŀ� ���Ǵ� �޸�(to avoid a disk seeks), '.
        'refer '.$this->stat['Created_tmp_disk_tables'][0].
        '[Created_tmp_disk_tables]'),
    'interactive_timeout' =>
        array(number_format($vars['interactive_timeout']).
        '('.$this->runtime($vars['interactive_timeout']).')',
        'interactive -> re-active�� ��ٸ��� �ð�(���� closed)'.
        $this->comments['interactive_timeout']),
    'wait_timeout' =>
        array(number_format($vars['wait_timeout']).
        '('.$this->runtime($vars['wait_timeout']).')',
        'none interactive -> re-active�� ��ٸ��� �ð�(���� closed), '.
        $this->comments['wto'].
        $this->comments['wait_timeout']),
    'timezone' =>
        array($vars['timezone'],
        '���� MySQL ������ TIME-ZONE'),
    'version' =>
        array($vars['version'],
        '���� MySQL ���� ����')
    );

    if($_v4003) unset($this->vars['safe_show_database']);
  }

  ## parsing to html
  ##
  ## arguments :
  ##    $color        array, parsing to TABLE cloor
  ##    $color['line']    string, line color of HTML table, default '#000000'
  ##    $color['th']    string, head color of HTML table, default '#CCCCCC'
  ##    $color['td']    string, TD color of HTML table, default '#FFFFFF'
  ##
  ##    $return        boolean, 1 return, 0 print
  ##
  function tohtml($color=array(), $return=0)
  {
    static $version = FALSE;

    if(!$this->_get) $this->_get();

    $this->_get = FALSE; // reset to false

    if(!$color) $color = $this->color;
    if(!$color['line']) $color['line'] = '#000000';
    if(!$color['th']) $color['th'] = '#CCCCCC';
    if(!$color['td']) $color['td'] = '#FFFFFF';

    if(!$version) $html = 'mysql status Ver. '.$this->version."<BR>\n";

    $version = TRUE;
    $t = array(array('���̺�','Ÿ��'),array('�����ͺ��̽�','����','(��)'));

    if($this->bits[0])
    {
        $html .= $this->db2html($this->mydb,$color,'MY',$t[0]);
        if($this->odb)
        {
            $tmp = array_keys($this->odb);
            foreach($tmp AS $key)
            { $html .= $this->db2html($this->odb[$key],$color,$key,$t[0]); }
            unset($tmp);
        }
        else if(sizeof($this->dbsum) > 1)
        {
            $html .= $this->db2html($this->dbsum,$color,'SUMMARY OF',$t[1]);
        }
    }

    //unset($t);

    if($this->bits[1]) $html .= $this->array2html($this->stat,$color,'STATUS');
    if($this->bits[2]) $html .= $this->array2html($this->vars,$color,'VARIABLES');

    if($return) return $html;
    else echo $html;
  }

  function db2html($array, $color, $name, $t)
  {
    $r =    '<B>'.$name.' DATABASE STATUS</B> (connected by '.$this->via.')'."\n".
        '<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 BGCOLOR='.$color['line'].'>'."\n".
        '<TR><TD>'."\n".
        '<TABLE BORDER=0 WIDTH=100% CELLPADDING=3 CELLSPACING=1>'."\n".
        '<TR BGCOLOR='.$color['th'].'>'."\n".
        '<TD ALIGN=right NOWRAP>'.$t[0].' �̸�</TD>'."\n".
        '<TD ALIGN=center NOWRAP>���̺� '.$t[1].'</TD>'."\n".
        '<TD ALIGN=right NOWRAP>���ڵ� ��'.$t[2].'</TD>'."\n".
        '<TD ALIGN=right NOWRAP>���ڵ� ��� ũ��</TD>'."\n".
        '<TD ALIGN=right NOWRAP>��뷮'.$t[2].'</TD>'."\n".
        '<TD ALIGN=right NOWRAP>Index ũ��'.$t[2].'</TD>'."\n".
        '</TR>'."\n";

    $nums = sizeof($array);
    for($i=0; $i<$nums; $i++)
    {
        $r .=    '<TR BGCOLOR='.$color['td'].'>'."\n".
            '<TD ALIGN=right>'.$array[$i]['name'].'</TD>'."\n".
            '<TD ALIGN=center>'.$array[$i]['type'].'</TD>'."\n".
            '<TD ALIGN=right>'.$array[$i]['rows'].'</TD>'."\n".
            '<TD ALIGN=right>'.$array[$i]['srow'].'</TD>'."\n".
            '<TD ALIGN=right>'.$array[$i]['size'].'</TD>'."\n".
            '<TD ALIGN=right>'.$array[$i]['sidx'].'</TD>'."\n".
            '</TR>'."\n";
    }

    $r .=    '</TABLE>'."\n".
        '</TD></TR>'."\n".
        '</TABLE>'."\n<BR>\n";

    return $r;
  }

  function array2html($array, $color, $name)
  {
    $r =    '<B>MYSQL SERVER '.$name.'</B> (connected by '.$this->via.
        ')'.$this->comments['poor']."\n".
        '<TABLE BORDER=0 WIDTH=100% CELLPADDING=0 CELLSPACING=0 '.
        'BGCOLOR='.$color['line'].'>'."\n".
        '<TR><TD>'."\n".
        '<TABLE BORDER=0 WIDTH=100% CELLPADDING=3 CELLSPACING=1>'."\n".
        '<TR BGCOLOR='.$color['th'].'>'."\n".
        '<TD WIDTH=25% ALIGN=right>�׸�</TD>'."\n".
        '<TD WIDTH=10% ALIGN=right>'.$name.'</TD>'."\n".
        '<TD WIDTH=65%>commnets, [***] ǥ�ô� ���� ���� ���õ�</TD>'."\n".
        '</TR>'."\n";

    $tmp = array_keys($array);
    foreach($tmp AS $key)
    {
        $r .=    '<TR BGCOLOR='.$color['td'].'>'."\n".
            '<TD ALIGN=right>'.$key.'</TD>'."\n".
            '<TD ALIGN=right NOWRAP>'.$array[$key][0].'</TD>'."\n".
            '<TD>'.$array[$key][1].'</TD>'."\n".
            '</TR>'."\n";
    }
    unset($tmp);

    $r .=    '</TABLE>'."\n".
        '</TD></TR>'."\n".
        '</TABLE>'."\n<BR>\n";

    return $r;
  }

  function hsize($bfsize, $sub=0)
  {
    $BYTES = number_format($bfsize).' Bytes';

    if($bfsize < 1024) return $BYTES;
    else if($bfsize < 1048576) $bfsize = number_format(round($bfsize/1024)).' KB';
    else if($bfsize < 1073741827) $bfsize = number_format(round($bfsize/1048576)).' MB';
    else $bfsize = number_format($bfsize/1073741827,1).' GB';

    if($sub) $bfsize .= '('.$BYTES.')';

    return $bfsize;
  }

  function runtime($term, $lang='kr')
  { 
    $l['kr'] = $l['ko'] = array('��','��','�ð�','��','��');
    $l['en'] = array('seconds','minutes','hours','days','months');
  
    $months    = (int)($term / 2592000);
    $term    = (int)($term % 2592000);
    $days    = (int)($term / 86400);
    $term    = (int)($term % 86400);
    $hours    = (int)($term / 3600);
    $term    = (int)($term % 3600);
    $mins    = (int)($term / 60);
    $secs    = (int)($term % 60);

    $months = $months ? $months.$l[$lang][4].' ' : '';
    $days = $days ? $days.$l[$lang][3].' ' : '';
    $hours = $hours ? $hours.$l[$lang][2].' ' : '';
    $mins = $mins ? $mins.$l[$lang][1].' ' : '';
    $secs .= $l[$lang][0];

    return $months.$days.$hours.$mins.$secs;
  }
} // end of class
?>
