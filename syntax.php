<?php
/**
 * DokuWiki Plugin editonlink (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Constant Illumination (Chang Zhao) <alex@obschy.ru>
 * @desc   For inner wiki links - a popover button [[linked:page?do=edit]]
 * @date: 13.11.2018


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
 */