<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$arComponentDescription = array(
    'NAME' => GetMessage('KORUS_NTLM_COMPONENT_NAME'),
    'DESCRIPTION' => GetMessage('KORUS_NTLM_REQUEST_COMPONENT_DESC'),
    'ICON' => '',
    'SORT' => 5,
    'CACHE_PATH' => 'Y',
    'PATH' => array(
        'ID' => 'content',
        'CHILD' => array(
            'ID' => 'korus',
            'NAME' => GetMessage('KORUS_NTLM_COMPONENT_GROUP'),
            'SORT' => 1,
        )
    ),
);
?>
