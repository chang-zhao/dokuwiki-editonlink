<?php
/**
 * DokuWiki Plugin editonlink (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Constant Illumination (Chang Zhao) <alex@obschy.ru>
 * @desc   For inner wiki links - a popover button [[linked:page?do=edit]]
 * @date: 13.11.2018
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_test extends DokuWiki_Syntax_Plugin {

    function getType(){ return 'substition'; }
    function getPType(){ return 'normal'; }
    function getSort(){ return 295; }

    function connectTo($mode) {
        $this->Lexer->addEntryPattern('\[\[',$mode,'plugin_editonlink');
        $this->Lexer->addExitPattern(']]','plugin_editonlink');
    }
    /**
     * Handler to prepare matched data for the rendering process.
     *
     * <p>
     * The <tt>$aState</tt> parameter gives the type of pattern
     * which triggered the call to this method:
     * </p>
     * <dl>
     * <dt>DOKU_LEXER_ENTER</dt>
     * <dd>a pattern set by <tt>addEntryPattern()</tt></dd>
     * <dt>DOKU_LEXER_MATCHED</dt>
     * <dd>a pattern set by <tt>addPattern()</tt></dd>
     * <dt>DOKU_LEXER_EXIT</dt>
     * <dd> a pattern set by <tt>addExitPattern()</tt></dd>
     * <dt>DOKU_LEXER_SPECIAL</dt>
     * <dd>a pattern set by <tt>addSpecialPattern()</tt></dd>
     * <dt>DOKU_LEXER_UNMATCHED</dt>
     * <dd>ordinary text encountered within the plugin's syntax mode
     * which doesn't match any pattern.</dd>
     * </dl>
     * @param $aMatch String The text matched by the patterns.
     * @param $aState Integer The lexer state for the match.
     * @param $aPos Integer The character position of the matched text.
     * @param $aHandler Object Reference to the Doku_Handler object.
     * @return Integer The current lexer state for the match.
     * @public
     * @see render()
     * @static
     */
    function handle($match, $state, $pos, &$handler){
        switch ($state) {
            case DOKU_LEXER_ENTER :
                break;
            case DOKU_LEXER_MATCHED :
                break;
            case DOKU_LEXER_UNMATCHED :
                break;
            case DOKU_LEXER_EXIT :
                break;
            case DOKU_LEXER_SPECIAL :
                break;
        }
        return array();
    }

    /**
     * Handle the actual output creation.
     *
     * <p>
     * The method checks for the given <tt>$aFormat</tt> and returns
     * <tt>FALSE</tt> when a format isn't supported. <tt>$aRenderer</tt>
     * contains a reference to the renderer object which is currently
     * handling the rendering. The contents of <tt>$aData</tt> is the
     * return value of the <tt>handle()</tt> method.
     * </p>
     * @param $aFormat String The output format to generate.
     * @param $aRenderer Object A reference to the renderer object.
     * @param $aData Array The data created by the <tt>handle()</tt>
     * method.
     * @return Boolean <tt>TRUE</tt> if rendered successfully, or
     * <tt>FALSE</tt> otherwise.
     * @public
     * @see handle()
     */
    function render($mode, &$renderer, $data) {
        if($mode == 'xhtml'){
            $renderer->doc .= "Hello World!";            // ptype = 'normal'
//            $renderer->doc .= "<p>Hello World!</p>";     // ptype = 'block'
            return true;
        }
        return false;
    }
}













class syntax_plugin_editonlink extends DokuWiki_Syntax_Plugin {
    function getType() {
        return 'substition';
    }

    function getPType() {
        return 'block';
    }

    function getSort() {
        return 295;
    }


    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('{{simplenavi>[^}]*}}',$mode,'plugin_simplenavi');
    }

    function handle($match, $state, $pos, Doku_Handler $handler){
        $data = array(cleanID(substr($match,13,-2)));

        return $data;
    }

    function render($mode, Doku_Renderer $R, $pass) {
        if($mode != 'xhtml') return false;

        global $conf;
        global $INFO;
        $R->info['cache'] = false;

        $ns = utf8_encodeFN(str_replace(':','/',$pass[0]));
        $data = array();
        search($data,$conf['datadir'],array($this,'_search'),array('ns' => $INFO['id']),$ns,1,'natural');
        if ($this->getConf('sortByTitle') == true) {
            $this->_sortByTitle($data,"id");
        } else {
            if ($this->getConf('sort') == 'ascii') {
                uksort($data, array($this, '_cmp'));
            }
        }

        $R->doc .= '<div class="plugin__simplenavi">';
        $R->doc .= html_buildlist($data,'idx',array($this,'_list'),array($this,'_li'));
        $R->doc .= '</div>';

        return true;
    }

    function _list($item){
        global $INFO;
        $link0 = '<span class="innerlink">';
        $link1 = html_wikilink(':'.$item['id'],$this->_title($item['id']));
        /* ToDo: move this to list bullet click & respect useslash: */
        $link2 = '<a class="editorlink" href="/'.str_replace(':','/',$item['id']).'?do=edit">✎</a></span>';

        if(($item['type'] == 'd' && $item['open']) || $INFO['id'] == $item['id']){

            return '<strong>'.$link0.$link1.$link2.'</strong>';
        }else{
            return $link0.$link1.$link2;
        }

    }

    function _li($item){
        if($item['type'] == "f"){
            return '<li class="level'.$item['level'].'">';
        }elseif($item['open']){
            return '<li class="open">';
        }else{
            return '<li class="closed">';
        }
    }

    function _search(&$data,$base,$file,$type,$lvl,$opts){
        global $conf;
        $return = true;

        $item = array();

        $id = pathID($file);

        if($type == 'd' && !(
                preg_match('#^'.$id.'(:|$)#',$opts['ns']) ||
                preg_match('#^'.$id.'(:|$)#',getNS($opts['ns']))

            )){
            //add but don't recurse
            $return = false;
        }elseif($type == 'f' && (!empty($opts['nofiles']) || substr($file,-4) != '.txt')){
            //don't add
            return false;
        }

        if($type=='d' && $conf['sneaky_index'] && auth_quickaclcheck($id.':') < AUTH_READ){
            return false;
        }

        if($type == 'd'){
            // link directories to their start pages
            $exists = false;
            $id = "$id:";
            resolve_pageid('',$id,$exists);
            $this->startpages[$id] = 1;
        }elseif(!empty($this->startpages[$id])){
            // skip already shown start pages
            return false;
        }elseif(noNS($id) == $conf['start']){
            // skip the main start page
            return false;
        }

        //check hidden
        if(isHiddenPage($id)){
            return false;
        }

        //check ACL
        if($type=='f' && auth_quickaclcheck($id) < AUTH_READ){
            return false;
        }

        $data[$id]=array( 'id'    => $id,
                          'type'  => $type,
                          'level' => $lvl,
                          'open'  => $return);
        return $return;
    }

    function _title($id) {
        global $conf;

        if(useHeading('navigation')){
            $p = p_get_first_heading($id);
        }
        if(!empty($p)) return $p;

        $p = noNS($id);
        if ($p == $conf['start'] || $p == false) {
            $p = noNS(getNS($id));
            if ($p == false) {
                return $conf['start'];
            }
        }
        return $p;
    }

    function _cmp($a, $b) {
        global $conf;
        $a = preg_replace('/'.preg_quote($conf['start'], '/').'$/', '', $a);
        $b = preg_replace('/'.preg_quote($conf['start'], '/').'$/', '', $b);
        $a = str_replace(':', '/', $a);
        $b = str_replace(':', '/', $b);

        return strcmp($a, $b);
    }

    function _sortByTitle(&$array, $key) {
        $sorter = array();
        $ret = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $this->_title($va[$key]);
        }
        if ($this->getConf('sort') == 'ascii') {
            uksort($sorter, array($this, '_cmp'));
        } else {
            natcasesort($sorter);
        }
        foreach ($sorter as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
    }

}

// vim:ts=4:sw=4:et:
