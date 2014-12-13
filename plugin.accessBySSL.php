/**
 * accessBySSL
 * 
 * <strong>1.0</strong> 指定したドキュメントへのリンクをSSLに変更する
 * @internal @events OnWebPagePrerender
 * @internal @properties &ids=書き換えるドキュメントID(コンマ区切り);int;9999999 &append=追加する文字列;text;https://;
 */

if($modx->event->name !== 'OnWebPagePrerender')
	return;

include_once $modx->config['base_path'] . "assets/plugins/accessBySSL/accessBySSL.inc.php";

$t = new accessBySSL($ids, $append);
$t->process();
