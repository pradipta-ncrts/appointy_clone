<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class common_model extends Model {
    private $query;
    
    function get_all($table, $select = array(), $where = array(), $join = array(), $left = array(), $right = array(), $order = array(), $group = "", $limit = array(), $raw = "", $paging = "", $or_where = "", $having = array(), $raw_where = "", $where_in = array()) {
        $base = DB::table($table);
        if (!empty($select)) {
            $base->select($select);
        } else {
            $base->select('*');
        }
        if ($raw != "") {
            $base->select(DB::raw($raw));
        }
        if (!empty($where)) {
            foreach ($where as $wh) {
                $base->where($wh[0], $wh[1], $wh[2]);
            }
        }
        if (!empty($where_in)) {
            foreach ($where_in as $key=>$val) {
                if (!empty($val)) {
                    $base->whereIn($key, $val);
                }
            }
        }
        if (!empty($or_where)) {
            foreach ($or_where as $owh) {
                $base->orWhere($owh[0], $owh[1], $owh[2]);
            }
        }
        if (!empty($order)) {
            foreach ($order as $od) {
                foreach ($od as $key => $val) {
                    $base->orderby($key, $val);
                }
            }
        }
        if (!empty($left)) {
            foreach ($left as $lf) {
                $base->leftJoin($lf[0], $lf[1], $lf[2], $lf[3]);
            }
        }
        if (!empty($right)) {
            foreach ($right as $rt) {
                $base->rightjoin($rt[0], $rt[1], $rt[2], $rt[3]);
            }
        }
        if (!empty($join)) {
            foreach ($join as $jn) {
                $base->join($jn[0], $jn[1], $jn[2], $jn[3]);
            }
        }
        if ($group != "") {
            $base->groupby($group);
        }
        if (!empty($having)) {
            foreach ($having as $hv) {
                $base->having($hv[0], $hv[1], $hv[2]);
            }
        }
        // return $having;
        //return $raw;
        if (!empty($limit)) {
            foreach ($limit as $of => $lim) {
                $base->offset($of);
                $base->limit($lim);
            }
        }

        if ($raw_where != "") {

            $base->whereRaw(DB::raw($raw_where));
        }

        if ($paging != "") {
            $data = $base->paginate($paging);
        } else {

            $data = $base->get();
        }
        if (count($data) > 0) {
            return $data;
        } else {
            return false;
        }
        //return $data=array('head'=>"This is laravel",'body'=>"Welcome to my laravel application");
    }


    public function insert_data_get_id($table, $data) {
        $data['created_on'] = date('Y-m-d H:i:s');
        //$data['updated_on'] = date('Y-m-d H:i:s');

        $insert_data = DB::table($table)->insertGetId($data);
        return $insert_data;
    }

    public function insert_data($table, $data) {
        $insert_data = DB::table($table)->insert($data);
        return $insert_data;
    }


    public function update_data($table, $where, $data) {
        $base = DB::table($table);
        if (!empty($where)) {
            foreach ($where as $wh) {
                $base->where($wh[0], $wh[1], $wh[2]);
            }
        }
        $result = $base->update($data);
        return $result;
    }


    public function delete_data($table, $where) {
        $base = DB::table($table);
        if (!empty($where)) {
            foreach ($where as $wh) {
                $base->where($wh[0], $wh[1], $wh[2]);
            }
        }
        $result = $base->delete();
        return $result;
    }


    public function row_present_check($table, $where) {
        $base = DB::table($table);
        if (!empty($where)) {
            foreach ($where as $wh) {
                $base->where($wh[0], $wh[1], $wh[2]);
            }
        }

        $data = $base->get();
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
        
    }


    public function row_count($table_name, $select, $where, $joining, $group_by="") {
        $base = DB::table($table_name);
        if (!empty($select)) {
            $base->select($select);
        } else {
            $base->select('*');
        }
        if (!empty($where)) {
            foreach ($where as $wh) {
                $base->where($wh[0], $wh[1], $wh[2]);
            }
        }
        if (!empty($joining)) {
            foreach ($joining as $jn) {
                $base->join($jn[0], $jn[1], $jn[2], $jn[3]);
            }
        }
        if ($group_by != "") {
            $base->groupby($group_by);
        }
        $result = $base->count();
        return $result;
    }

    /**
     * @Author NCRTS
     * remove the record from the table
     * @param string $table_name
     * @param mixed $delete_condition
     * @return bool
     */
    public function removeDatas($table_name,$delete_condition){
        if(!empty($table_name)){
            // add the common param 
            $delete_condition[]=array('is_deleted','=','0');
            // update the data for we assum that is temporalily deleted
            $delete_data=array(
                'is_deleted'=>'1',
                'deleted_on'=>date("Y-m-d H:i:s")
            );
            // set the db section 
            $this->query = DB::table($table_name);
            $this->set_condition($delete_condition,$table_name);
            $result = $this->query->update($delete_data);
        }
    }

    /**
    * @Author NCRTS
    * remove the record from the table permanately
    * @param string $table_name
    * @param mixed $delete_condition
    * @return bool
    */
    public function deleteDatas($table_name='', $delete_condition=array()) {
        $result = false;
        if(!empty($table_name)){
            // set the db section 
            $this->query = DB::table($table_name);
            $this->set_condition($delete_condition,$table_name);
            $result = $this->query->delete();
        }
        return $result;
    }


    /**
     * @Author NCRTS
     * fetch multiple records
     * @param $tableName string,$conditions mixed, $selectFields mixed,$joins mixed,$orderBy mixed,
     * $groupBy string,$havings mixed,$limit integer,$offset integer, $is_count bool
     * @return array
     */
    public function fetchDatas($tableName='',$conditions=array(),$selectFields=array(),$joins=array(),$orderBy=array(),$groupBy='',$havings=array(),$limit=0,$offset=0,$is_count=0){
        $datas=array();
        if(empty($tableName)){
            return $datas;
        }
        // set the db section 
        $this->query = DB::table($tableName);
        // set selection fields
        $this->set_select_fileds($selectFields,$tableName);
        // set contdition section 
        if(!empty($conditions)){
            if(is_array($conditions)){
                //$conditions[] = array('is_deleted','=',0);
                $this->set_condition($conditions,$tableName);
            }
            else{
                $this->query->whereRaw(DB::raw($conditions));
            }
        }
        
        // set join section 
        $this->set_join($joins);

        //order by
        if(!empty($orderBy)){
            if(is_array($orderBy)){
                foreach($orderBy as $fld=>$order){
                    if(strpos($fld,".")===false){
                        $this->query->orderBy($tableName.'.'.$fld,$order);
                    }
                    else{
                        $this->query->orderBy($fld,$order);
                    }
                }
            }
            else{
                $this->query->orderByRaw(DB::raw($orderBy));
            }
        }
        // group by
        if(!empty($groupBy)){
            if(empty($joins)){
                //$this->query->groupBy($groupBy);
                if(strpos($groupBy,"(")!==false){
                    $this->query->groupBy(DB::raw($groupBy));
                }
                else{
                    $this->query->groupBy($groupBy);
                }
            }
            else{
                if(strpos($groupBy,".")!==false){
                    $this->query->groupBy(DB::raw($groupBy));
                }
                else{
                    $this->query->groupBy($tableName.'.'.$groupBy);
                }
            }
        }
        
        // having
        if(!empty($havings)){
            if(is_array($havings)){
                foreach($havings as $having){
                    if(count($having)==3){
                        $this->query->having($having[0],$having[1],$having[2]);
                    }
                }
            }
            else{
                $this->query->havingRaw(DB::raw($havings));
            }
        }
        // query section setting change 
        $this->query_setting();
        // for counting section
        if(!$is_count){
            
            // limit and offset
            if($offset>0){
                $this->query->skip($offset);
            }
            if($limit>0){
                $this->query->take($limit);
            }
            // execuite section
            $datas = $this->query->get();
        }
        else{
            // execuite section
            $this->query->addSelect(DB::raw('IFNULL(count(*),0) as aggregate'));
            $datas = $this->query->first();
            if(!empty($datas)){
                $datas = $datas->aggregate;
            }
            else{
                $datas=0;
            }
        }
        return $datas;
    }

    /**
     * @Author NCRTS
     * fetch one record
     * @param $tableName string,$conditions mixed, $selectFields mixed,$joins mixed,$orderBy mixed,
     * $groupBy string,$havings mixed
     * @return array
     */
    public function fetchData($tableName='',$conditions=array(),$selectFields=array(),$joins=array(),$orderBy=array(),$groupBy='',$havings=array()){
        $datas=array();
        if(empty($tableName)){
            return $datas;
        }
        // set the db section 
        $this->query = DB::table($tableName);
        // select section 
        /*if(!empty($selectFields)){
            if(is_array($selectFields)){
                foreach($selectFields as $select_field){
                    $this->query->addSelect($tableName.'.'.$select_field);
                }
            }
        }
        else{
            $this->query->addSelect($tableName.'.*');
        }*/
        // set selection fields
        $this->set_select_fileds($selectFields,$tableName);

        // set contdition section 
        $conditions[] = array('is_deleted','=',0);
        $this->set_condition($conditions,$tableName);
        // set join section 
        $this->set_join($joins);

        //order by
        if(!empty($orderBy)){
            if(is_array($orderBy)){
                foreach($orderBy as $fld=>$order){
                    if(strpos($fld,".")===false){
                        $this->query->orderBy($tableName.'.'.$fld,$order);
                    }
                    else{
                        $this->query->orderBy($fld,$order);
                    }
                }
            }
            else{
                $this->query->orderBy(DB::raw($orderBy));
            }
        }
        // group by
        if(!empty($groupBy)){
            if(empty($joins)){
                $this->query->groupBy($groupBy);
            }
            else{
                $this->query->groupBy($tableName.'.'.$groupBy);
            }
        }
        // having
        if(!empty($havings)){
            if(is_array($havings)){
                foreach($havings as $having){
                    if(count($having)==3){
                        $this->query->having($having[0],$having[1],$having[2]);
                    }
                }
            }
            else{
                $this->query->having(DB::raw($havings));
            }
        }
        // query section setting change 
        $this->query_setting();
        // execuite section
        $datas = $this->query->first(); 
        return $datas;
    }

    /**
     * update the records
     * 
     */
    public function updateDatas($tableName='',$updateConds=array(),$updateDatas=array()){
        if(empty($tableName)){
            return false;
        }
        // set the db section 
        $this->query = DB::table($tableName);
        // create the conditions 
        // set the updated time 
        $updateDatas['updated_on']=date("Y-m-d H:i:s");

        $this->set_condition($updateConds);
        $result = $this->query->update($updateDatas,$tableName);
        return $result;
    }
    /**
     * @Author NCRTS
     * fetch record by custom query
     * @param $query string, $query_type string
     * @return array
     */
    public function customQuery($query='',$query_type=0){
        // 0 for Statement, 1 for select, 2 for insert, 3 for update, 4 for delete
        $datas=array();
        if(empty($query)){
            return $datas;
        } else {
            switch($query_type){
                case 1:
                $func_name = 'select';
                break;
                case 2:
                $func_name = 'insert';
                break;
                case 3:
                $func_name = 'update';
                break;
                case 2:
                $func_name = 'delete';
                break;
                default:
                $func_name = 'statement';
                break;
            }
            $datas = DB::$func_name($query);
            
        }
        return $datas;
    }

    /**
     * @Author NCRTS
     * build the query selection
     * @param $selectFields mixed
     * @param $tableName string
     * @return void
     */
    public function set_select_fileds($selectFields=array(),$tableName=''){
        // select section 
        if(!empty($selectFields)){
            if(is_array($selectFields)){
                foreach($selectFields as $select_field){
                    //if found ( then
                    if(strpos($select_field,"(") === false){
                        if(!empty($tableName)){
                            $this->query->addSelect($tableName.'.'.$select_field);
                        }
                        else{
                            $this->query->addSelect($select_field);
                        }
                    }
                    else{
                        $this->query->addSelect($select_field);
                    }
                }
            }
            else{
                $this->query->addSelect(DB::raw($selectFields));
            }
        }
        else{
            if(!empty($tableName)){
                $this->query->addSelect($tableName.'.*');
            }
            else{
                $this->query->addSelect('*');
            }
        }
    }


    /**
     * @Author NCRTS
     * build the query condition
     * @param $conditions mixed
     * @param $tableName string
     * @return void
     */
    private function set_condition($conditions=array(),$tableName=''){
        if(!empty($conditions)){

            // find if OR clouse present
            if(isset($conditions['or'])){
                $orwheres = $conditions['or'];
                if(!empty($orwheres)){
                    if(is_array($orwheres)){
                        if(count($orwheres)>0){
                            $this->query->where(function($orq)use($orwheres,$tableName){
                                foreach($orwheres as $fld=>$vals){
                                    if(strpos($fld,".")!==false){
                                        $orq->orWhere($fld,$vals);// orWhere('fld_name','value')
                                    }
                                    else{
                                        if(!empty($tableName)){
                                            $orq->orWhere($tableName.'.'.$fld,$vals);// orWhere('fld_name',value)
                                        }
                                        else{
                                            $orq->orWhere($fld,$vals);// orWhere('fld_name',value)
                                        }
                                    }
                                }
                            });
                        }
                    }
                    else{
                        // string section
                        $this->query->orWhereRaw(DB::raw($orwheres));
                    }
                }
                // unset the or section 
                unset($conditions['or']);
            }

            // find if BETWEEN clouse present
            if(isset($conditions['between'])){
                $betweenWheres = $conditions['between'];
                if(!empty($betweenWheres)){
                    if(is_array($betweenWheres)){
                        foreach($betweenWheres as $fld=>$vals){
                            if(strpos($fld,".")!==false){
                                $this->query->whereBetween($fld,$vals);// whereBetween('fld_name',array())
                            }
                            else{
                                if(!empty($tableName)){
                                    $this->query->whereBetween($tableName.'.'.$fld,$vals);// whereBetween('fld_name',array())
                                }
                                else{
                                    $this->query->whereBetween($fld,$vals);// whereBetween('fld_name',array())
                                }
                            }
                        }
                    }
                    else{
                        // string section
                        $this->query->whereBetweenRaw(DB::raw($betweenWheres));
                    }
                }
                // unset the or section 
                unset($conditions['between']);
            }

            // find if NOT BETWEEN clouse present
             if(isset($conditions['notbetween'])){
                $notBetweenWheres = $conditions['notbetween'];
                if(!empty($notBetweenWheres)){
                    if(is_array($notBetweenWheres)){
                        foreach($notBetweenWheres as $fld=>$vals){
                            if(strpos($fld,".")===false){
                                $this->query->whereNotBetween($fld,$vals);// whereBetween('fld_name',array())
                            }
                            else{
                                $this->query->whereNotBetween($tableName.'.'.$fld,$vals);// whereBetween('fld_name',array())
                            }
                        }
                    }
                    else{
                        // string section
                    }
                }
                // unset the or section 
                unset($conditions['notbetween']);
            }

            // find if IN clouse present
             if(isset($conditions['in'])){
                $inWheres = $conditions['in'];
                if(!empty($inWheres)){
                    if(is_array($inWheres)){
                        foreach($inWheres as $fld=>$vals){
                            if(strpos($fld,".")!==false){
                                $this->query->whereIn($fld,$vals); // whereIn('fld_name',array())
                            }
                            else{
                                if(!empty($tableName)){
                                    $this->query->whereIn($tableName.'.'.$fld,$vals); // whereIn('fld_name',array())
                                }
                                else{
                                    $this->query->whereIn($fld,$vals); // whereIn('fld_name',array())
                                }
                            }
                        }
                    }
                    else{
                        // string section
                    }
                }
                // unset the or section 
                unset($conditions['in']);
            }
            // find if NOTIN clouse present
            if(isset($conditions['notin'])){
                $notInWheres = $conditions['notin'];
                if(!empty($notInWheres)){
                    if(is_array($notInWheres)){
                        foreach($notInWheres as $fld=>$vals){
                            if(strpos($fld,".")===false){
                                $this->query->whereNotIn($fld,$vals); // whereNotIn('fld_name',array())
                            }
                            else{
                                $this->query->whereNotIn($tableName.'.'.$fld,$vals); // whereNotIn('fld_name',array())
                            }
                        }
                    }
                    else{
                        // string section
                    }
                }
                // unset the or section 
                unset($conditions['notin']);
            }

            // find if NOTIN clouse present
            if(isset($conditions['null'])){
                $nullWheres = $conditions['null'];
                if(!empty($nullWheres)){
                    if(is_array($nullWheres)){
                        foreach($nullWheres as $vals){
                            if(strpos($vals,".")!==false){
                                $this->query->whereNull($vals); // whereNull('fld_name')
                            }
                            else{
                                $this->query->whereNull($tableName.'.'.$vals); // whereNull('fld_name')
                            }
                        }
                    }
                    else{
                        // string section
                        $this->query->whereNull($nullWheres);
                    }
                }
                // unset the or section 
                unset($conditions['null']);
            }

            // find if NOTIN clouse present
            if(isset($conditions['notnull'])){
                $notnullWheres = $conditions['notnull'];
                if(!empty($notnullWheres)){
                    if(is_array($notnullWheres)){
                        foreach($notnullWheres as $vals){
                            if(strpos($fld,".")===false){
                                $this->query->whereNotNull($vals); // whereNotNull('fld_name')
                            }
                            else{
                                $this->query->whereNotNull($tableName.'.'.$vals); // whereNotNull('fld_name')
                            }
                        }
                    }
                    else{
                        // string section
                        $this->query->whereNotNull($notnullWheres);
                    }
                }
                // unset the or section 
                unset($conditions['notnull']);
            }


            // find if raw clouse present
            if(isset($conditions['raw'])){
                $rawcond = $conditions['raw'];
                if(!empty($rawcond)){
                    $this->query->whereRaw(DB::raw($rawcond));
                }
                // unset the or section 
                unset($conditions['raw']);
            }

            // normal conditions
            if(is_array($conditions)){
                foreach($conditions as $condition){
                    $is_raw_allow=false;
                    $fld = $condition[0];
                    if(strpos($fld,".")===false){
                         //if found ( then
                        if(strpos($fld,"(") === false){
                            if(!empty($tableName)){
                                $fld=$tableName.'.'.$fld;
                            }
                        }
                        else{
                            $is_raw_allow=true;
                        }
                    }

                    if($is_raw_allow){
                        $this->query->whereRaw(DB::raw($fld.$condition[1].$condition[2]));
                    }
                    else{
                        if(count($condition)==3){
                            $this->query->where($fld,$condition[1],$condition[2]);
                        }
                        else{
                            $this->query->where($fld,$condition[1]);
                        }
                    }
                    
                }
            }
            else{
                // if any string value in where conditions
            }
        }
    }
    
    /**
     * @Author NCRTS
     * build the query joins
     * @param $joins mixed
     * @return void
     */
    private function set_join($joins=array()){
        /**
         * join array format
         * array(
         *  array(
         *      'join_with'=>'tableName1',
         *      'join_with_alias'=>'',
         *      'join_type'=>'inner/left/cross/',
         *      'join_table'=>'tableName2',
         *      'join_table_alias'=>'',
         *      'join_on'=>array('tableName1.fieldName','oparetor',tableName2.fieldName'),
         *      'join_on_more'=>array(array(fieldName,'=',fieldValue)),
         *      'join_conditions'=>array(array('fieldName','oparetor','value')),
         *      'select_fields'=>array()
         * )
         * )
         */
        if(!empty($joins)){
            if(is_array($joins)){
                foreach($joins as $join){
                    $join_with = isset($join['join_with'])?strtolower($join['join_with']):''; // table name
                    $join_with_alias = isset($join['join_with_alias'])?($join['join_with_alias']):'';
                    $join_type = isset($join['join_type'])?$join['join_type']:'';
                    $join_table = isset($join['join_table'])?strtolower($join['join_table']):''; // table name
                    $join_table_alias = isset($join['join_table_alias'])?($join['join_table_alias']):'';
                    $join_on = isset($join['join_on'])?$join['join_on']:array();
                    $join_on_mores = isset($join['join_on_more'])?$join['join_on_more']:array();
                    $join_conditions = isset($join['join_conditions'])?$join['join_conditions']:array();
                    $select_fields = isset($join['select_fields'])?$join['select_fields']:'';

                    if(!empty($join_with) && !empty($join_type) && !empty($join_table) && !empty($join_on)){
                        
                        $tablePrefix='';
                        $j_W_t_name = $join_with;
                        if(!empty($join_with_alias)){
                            $j_W_t_name .=" AS ".$join_with_alias;
                            $join_with =  $join_with_alias;
                        }
                        //join table 
                        $j_t_name = $join_table;
                        if(!empty($join_table_alias)){
                            $j_t_name.=" AS ".$join_table_alias;
                            $join_table = $join_table_alias;
                        }
                       
                        // update the join params 
                        $join_on=array($join_with.'.'.$join_on[0],$join_on[1],$join_table.'.'.$join_on[2]);
                        
                        if($join_type=='inner'){
                            //$tablePrefix = DB::getTablePrefix();
                            $this->query->join($j_t_name,function($jn) use($join_on,$join_on_mores,$join_conditions,$join_table){
                                $jn->on($join_on[0],$join_on[1],$join_on[2]);
                                // extra join on section
                                if(!empty($join_on_mores)){
                                    if(is_array($join_on_mores)){
                                        foreach($join_on_mores as $join_on_more){
                                            if(count($join_on_more)==3){
                                                $jn->where($join_table.'.'.$join_on_more[0],$join_on_more[1],$join_on_more[2]);
                                            }
                                        }
                                    }
                                }
                            });
                        }
                        else if($join_type=='left'){
                            $tablePrefix = DB::getTablePrefix();
                            $this->query->leftJoin($j_t_name,function($jn) use($join_on,$join_on_mores,$join_conditions,$join_table,$j_t_name){
                                $jn->on($join_on[0],$join_on[1],$join_on[2]);
                                // extra join on section
                                if(!empty($join_on_mores)){
                                    if(is_array($join_on_mores)){
                                        foreach($join_on_mores as $join_on_more){
                                            if(count($join_on_more)==3){
                                                $jn->where($join_table.'.'.$join_on_more[0],$join_on_more[1],$join_on_more[2]);
                                            }
                                        }
                                    }
                                }
                                
                            });
                        }
                        else if($join_type=='cross'){
                            $this->query->crossJoin($j_t_name,function($jn) use($join_on,$join_on_mores,$join_conditions,$join_table){
                                $jn->on($join_on[0],$join_on[1],$join_on[2]);
                                // extra join on section
                                if(!empty($join_on_mores)){
                                    if(is_array($join_on_mores)){
                                        foreach($join_on_mores as $join_on_more){
                                            if(count($join_on_more)==3){
                                                $jn->where($join_table.'.'.$join_on_more[0],$join_on_more[1],$join_on_more[2]);
                                            }
                                        }
                                    }
                                }
                            });
                        }

                        //condition section 
                        if(!empty($join_conditions)){
                            if(is_array($join_conditions)){
                                if(!empty($tablePrefix)){
                                    //$j_t_name=$tablePrefix.$join_table;
                                }
                                $this->set_condition($join_conditions,$join_table);
                            }
                        }
                        // secelt fields section 
                        if(!empty($select_fields)){
                            if(is_array($select_fields)){
                                foreach($select_fields as $select_field){
                                    if(!empty($tablePrefix)){
                                        $alias=$select_field;
                                        $flds = explode(" ",$select_field);
                                        if(count($flds)==3){
                                            unset($flds[1]);
                                            $flds=array_values($flds);
                                        }
                                        
                                        if(count($flds)==2){
                                            $alias = $flds[1];
                                            $select_field = $flds[0];
                                        }
                                        $j_t=$tablePrefix.$join_table;
                                        $ss = "IFNULL($j_t.$select_field,'') AS $alias";
                                        $this->query->addSelect(DB::raw($ss));
                                    }
                                    else{
                                        $this->query->addSelect($join_table.'.'.$select_field);
                                    }
                                }
                            }
                            else{
                                $this->query->addSelect(DB::raw($select_fields));
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * make the db memory increase for the query lavel execution
     */
    public function query_setting(){
        $this->customQuery("SET SESSION group_concat_max_len=20000");
    }
}

