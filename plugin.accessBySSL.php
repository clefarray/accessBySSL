/**
 * accessBySSL
 * 
 * <strong>1.0</strong> 指定したドキュメントへのリンクをSSLに変更する
 * @internal @events OnWebPagePrerender
 * プラグイン設定: &ids=書き換えるドキュメントID(コンマ区切り);int;1 &append=追加する文字列;text;https://;
 */

include_once $modx->config['rb_base_dir'] . "plugins/accessBySSL/accessBySSL.inc.php";
$e = &$modx->Event;

switch($e->name) {
    case "OnWebPagePrerender":
        $t = new accessBySSL($ids, $append);
        $t->process();
        break;
}
