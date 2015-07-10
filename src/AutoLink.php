<?php

namespace Madlines\Common\AutoLink;

/**
 * Madlines AutoLink replaces all occurences of urls into anchors
 *
 * @author  Aleksander Ciesiolkiewicz <a.ciesiolkiewicz@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
class AutoLink
{
    const URL_REGEXP_WITHOUT_PROTOCOL = '_(^|\s)(www\.[\w\d\-\.:]+\.[\w]{2,8}(:\d+)?(/[\w\d/#?:\-=]+)?)_i';
    const URL_REGEXP_WITH_PROTOCOL = '_(https?://)([\w\d\-\.:]+\.[\w]{2,8}(:\d+)?(/[\w\d/#?:\-=]+)?)_i';
    const FTP_URL_REGEXP_WITH_PROTOCOL = '_(ftps?://)([\w\d\-\.:]+\.[\w]{2,8}(:\d+)?(/[\w\d/#?:\-=]+)?)_i';

    /**
     * @param string input
     * @return string
     */
    public static function parse($input)
    {
        $urlWithProtocol = '$1http://$2$3';
        $anchor = '<a href="$0" target="_blank">$2</a>';
        $ftpAnchor = '<a href="$0" target="_blank">$0</a>';

        $replaced = preg_replace(
            self::URL_REGEXP_WITHOUT_PROTOCOL,
            $urlWithProtocol,
            (string) $input
        ) ?: (string) $input;

        $replaced = preg_replace(
            self::URL_REGEXP_WITH_PROTOCOL,
            $anchor,
            $replaced
        ) ?: $replaced;

        $replaced = preg_replace(
            self::FTP_URL_REGEXP_WITH_PROTOCOL,
            $ftpAnchor,
            $replaced
        ) ?: $replaced;

        return $replaced;
    }
}
