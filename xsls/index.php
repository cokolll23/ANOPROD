<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("XSLS");

use Lab\Helpers\UsersHelpers as UH;
use Bitrix\Main\UserTable;

?>
<?php
// https://www.aconvert.com/ru/document/xls-to-json/
// https://disk.yandex.ru/i/flfIQx5xrHBUOQ
// скопировать и вставить json

$jsonFileMasurov = '[
{"field1":"Абдрахманова Эмилия Равилевна","field2":"87aee931-9c27-11ef-afe7-00155d000910","field3":"AbdrakhmanovaER@mos.ru"}
,
{"field1":"Аблонский Роман Алексеевич","field2":"e6954e05-cfc7-11ee-aee0-00155d000910","field3":"ablonskiyra@mos.ru"}
,
{"field1":"Адамчук Лидия Николаевна","field2":"f8736c45-2efa-11f0-b0a3-00155d000912","field3":"adamchukln@mos.ru"}
,
{"field1":"Азарова Анастасия Юрьевна","field2":"e6650b10-53be-11ef-af8a-00155d000912","field3":"AzarovaAY1@mos.ru"}
,
{"field1":"Азарова Лариса Владимировна","field2":"db164982-5e53-11f1-b228-00155d000912","field3":"AzarovaLV@mos.ru"}
,
{"field1":"Айрапетян Екатерина Игоревна","field2":"c4bb5573-5fa4-11eb-aa59-00155d1a381f","field3":"KarapetyanEI@mos.ru"}
,
{"field1":"Аксёнова Алина Алексеевна","field2":"d10e337f-7ccf-11f0-b106-00155d000912","field3":"aksenovaaa2@mos.ru"}
,
{"field1":"Аксентьева Светлана Андреевна","field2":"da065527-8186-11f0-b10c-00155d000912","field3":"aksentevasa@mos.ru"}
,
{"field1":"Александрова Анна Сергеевна","field2":"6bc5493b-6007-11f1-b22a-00155d000910","field3":"AleksandrovaAS8@it.mos.ru"}
,
{"field1":"Алексеев Антон Вячеславович","field2":"4eae540f-7151-11ed-ad13-00155d000910","field3":"AlekseevAV22@mos.ru"}
,
{"field1":"Алексина Ирина Владимировна","field2":"029cf27c-27c1-11ef-af52-00155d000910","field3":"AleksinaIV@mos.ru"}
,
{"field1":"Алешина Алена Игоревна","field2":"ffe2d2c9-ad02-11ed-ad68-00155d000910","field3":"AleshinaAI@mos.ru"}
,
{"field1":"Анашкин Артем Игоревич","field2":"546347f9-9c0f-11ef-afe7-00155d000910","field3":"AnashkinAI3@mos.ru"}
,
{"field1":"Андриянова Мария Александровна","field2":"7f3738be-ec03-11ee-af06-00155d000912","field3":"AndriyanovaMA@mos.ru"}
,
{"field1":"Аникеев Евгений Александрович","field2":"11e887d6-326e-11ed-acc2-00155d000912","field3":"AnikeevEA@mos.ru"}
,
{"field1":"Анисимова Александра Дмитриевна","field2":"3ba86ee8-ba11-11f0-b154-00155d000910","field3":"anisimovaad2@mos.ru"}
,
{"field1":"Анисимова Вера Николаевна","field2":"0dfb5bb8-d797-11ee-aeea-00155d000910","field3":"anisimovavn@mos.ru"}
,
{"field1":"Анисимова Елена Владимировна","field2":"160483e8-4909-11eb-aa3a-00155d1a381f","field3":"AnisimovaEV1@mos.ru"}
,
{"field1":"Аннамухамедов Батыр Арсланович","field2":"626fd319-72b1-11ec-abb7-00155d051a08","field3":"AnnamukhamedovBA1@mos.ru"}
,
{"field1":"Антипова Екатерина Андреевна","field2":"57033d32-6d0f-11f0-b0f2-00155d000912","field3":"antipovaea5@mos.ru"}
,
{"field1":"Антипова Мария Викторовна","field2":"ff3fcb71-5645-11f0-b0d4-00155d000910","field3":"AntipovaMV7@mos.ru"}
,
{"field1":"Антюхова Лилия Рамилевна","field2":"f30ff402-c3ca-11ed-ad85-00155d000912","field3":"AntyukhovaLR2@mos.ru"}
,
{"field1":"Анурова Майя Александровна","field2":"96af2245-2837-11f1-b1e3-00155d000912","field3":"AnurovaMA@mos.ru"}
,
{"field1":"Аншакова Татьяна Геннадьевна","field2":"b63237f6-92e3-11ec-abe0-00155d051a08","field3":"AnshakovaTG@mos.ru"}
,
{"field1":"Аншакова Юлия Николаевна","field2":"66d1e0bd-570e-11f0-b0d5-00155d000912","field3":"anshakovayn1@mos.ru"}
,
{"field1":"Апенянская София Витальевна","field2":"9cda7961-7102-11f0-b0f7-00155d000912","field3":"apenyanskayasv@mos.ru"}
,
{"field1":"Аржанова Анастасия Дмитриевна","field2":"d224554d-2838-11f1-b1e3-00155d000912","field3":"ArzhanovaAD@mos.ru"}
,
{"field1":"Арнаутова Александра Евгеньевна","field2":"94ab771e-ca97-11f0-b169-00155d000910","field3":"arnautovaae@mos.ru"}
,
{"field1":"Артамошкина Наталья Викторовна","field2":"133032c5-66c1-11ef-afa2-00155d000912","field3":"artamoshkinanv@mos.ru"}
,
{"field1":"Асаилова Анастасия Ильинична","field2":"fd897487-ca42-11ee-aed9-00155d000910","field3":"KalenkovaAI@mos.ru"}
,
{"field1":"Асонова Софья Олеговна","field2":"cd6c0680-2904-11f1-b1e4-00155d000910","field3":"AsonovaSO@mos.ru"}
,
{"field1":"Афанасьева Дарья Ивановна","field2":"d2db1e3e-d18f-11ef-b02b-00155d000910","field3":"afanasevadi@mos.ru"}
,
{"field1":"Ахмедзянова Евгения Викторовна","field2":"1864ca57-0e4d-11ed-ac92-00155d000910","field3":"Evgeshaah@gmail.com"}
,
{"field1":"Бабаева Зарина Феликсовна","field2":"82492613-6bef-11ee-ae60-00155d000910","field3":"BabaevaZF@mos.ru"}
,
{"field1":"Базин Сергей Сергеевич","field2":"5a54726c-64b3-11ed-ad03-00155d000910","field3":"BazinSS@mos.ru"}
,
{"field1":"Баландюк Максим Игоревич","field2":"58f41ef5-47f5-11ef-af7b-00155d000910","field3":"balandyukmi@mos.ru"}
,
{"field1":"Балбекова Дарья Эдуардовна","field2":"f89deb06-e5bc-11ee-aefe-00155d000912","field3":"BalbekovaDE@mos.ru"}
,
{"field1":"Баранивская Наталья Викторовна","field2":"b69d4aeb-23d1-11ef-af4d-00155d000912","field3":"BaranivskayaNV@mos.ru"}
,
{"field1":"Баранова Екатерина Владимировна","field2":"f0c76e63-bcb6-11ed-ad7c-00155d000910","field3":"BaranovaEV4@mos.ru"}
,
{"field1":"Барашкова Полина Сергеевна","field2":"afa2981a-23fc-11f0-b093-00155d000910","field3":"BarashkovaPS@mos.ru"}
,
{"field1":"Барлова Александра Олеговна","field2":"507a460c-4201-11f1-b204-00155d000910","field3":"barlovaao@mos.ru"}
,
{"field1":"Бауман Елена Михайловна","field2":"d1459439-af85-11ee-aeb7-00155d000912","field3":"BaumanEM@mos.ru"}
,
{"field1":"Белик Сергей Сергеевич","field2":"503f1a8f-b3e2-11ec-ac0a-00155d051a08","field3":"BelikSS@mos.ru"}
,
{"field1":"Беликова Валерия Валерьевна","field2":"fc85337c-d724-11f0-b17b-00155d000912","field3":"lerika-2000@yandex.ru"}
,
{"field1":"Белкина Екатерина Дмитриевна","field2":"93c8dddb-5b27-11f0-b0da-00155d000910","field3":"belkinaed@mos.ru"}
,
{"field1":"Белов Илья Игоревич","field2":"648f2c38-2849-11f1-b1e3-00155d000912","field3":"belovii@mos.ru"}
,
{"field1":"Белозерова Анастасия Александровна","field2":"daf5bf64-52c3-11f1-b219-00155d000912","field3":"belozerovaaa4@it.mos.ru"}
,
{"field1":"Белявцева Мария Сергеевна","field2":"a6fd3571-4ac2-11ed-ace1-00155d000912","field3":"BelyavtsevaMS@mos.ru"}
,
{"field1":"Белявцева Ольга Андреевна","field2":"b0f4d1d9-607c-11f0-b0e1-00155d000912","field3":"belyavtsevaoa1@mos.ru"}
,
{"field1":"Бережной Сергей Викторович","field2":"c4786dc9-37ad-11ef-af66-00155d000910","field3":"BerezhnoySV3@mos.ru"}
,
{"field1":"Березнева Анастасия Олеговна","field2":"9a11159a-b80b-11ed-ad76-00155d000912","field3":"IvanovaAO6@mos.ru"}
,
{"field1":"Берестовская Ольга Валентиновна","field2":"dc50e517-2187-11ef-af4a-00155d000910","field3":"berestovskayaov@mos.ru"}
,
{"field1":"Бирюков Андрей Андреевич","field2":"2bfde83d-fb45-11eb-ab1e-00155d051a08","field3":"BiryukovAA1@mos.ru"}
,
{"field1":"Бисярина Ольга Андреевна","field2":"877d95e6-ec7a-11ec-ac65-00155d000912","field3":"BisyarinaOA@mos.ru"}
,
{"field1":"Богодухова Снежана Григорьевна","field2":"17424852-283b-11f1-b1e3-00155d000912","field3":"BogodukhovaSG@mos.ru"}
,
{"field1":"Бодров Дмитрий Алексеевич","field2":"5175dca5-6347-11ee-ae55-00155d000910","field3":"dima1997_70@mail.ru"}
,
{"field1":"Болденкова Мария Вадимовна","field2":"81d82cfc-4527-11eb-aa35-00155d1a381f","field3":"BoldenkovaMV@mos.ru"}
,
{"field1":"Бондаренко Наталья Андреевна","field2":"7c08d582-5417-11f1-b21b-00155d000912","field3":"bondarenkona7@mos.ru"}
,
{"field1":"Борисов Денис Сергеевич","field2":"d1720e2d-3415-11e9-a98f-00155d1a3433","field3":"BorisovDS1@mos.ru"}
,
{"field1":"Борисов Дмитрий Михайлович","field2":"f26ec3fd-72a8-11f0-b0f9-00155d000912","field3":"borisovdm@mos.ru"}
,
{"field1":"Боровеева Татьяна Сергеевна","field2":"d1720e10-3415-11e9-a98f-00155d1a3433","field3":"BoroveevaTS@mos.ru"}
,
{"field1":"Бородкина Ирина Дмитриевна","field2":"1b337328-cb2e-11ee-aeda-00155d000912","field3":"BorodkinaID@mos.ru"}
,
{"field1":"Бородовская София Максимовна","field2":"bd3590ae-283b-11f1-b1e3-00155d000912","field3":"BorodovskayaSM@mos.ru"}
,
{"field1":"Боярский Андрей Алексеевич","field2":"e8073dad-b7ff-11ed-ad76-00155d000912","field3":"BoyarskiiAA@mos.ru"}
,
{"field1":"Брагина Ирина Ильинична","field2":"9bdddad5-76ea-11ee-ae6e-00155d000912","field3":"BraginaII@mos.ru"}
,
{"field1":"Брезгунов Олег Валерьевич","field2":"6a32ae9d-eea5-11ef-b04a-00155d000910","field3":"brezgunovov@mos.ru"}
,
{"field1":"Брик Ольга Васильевна","field2":"cde31fd6-ce1f-11e9-a994-00155d1a3432","field3":"BrikOV@mos.ru"}
,
{"field1":"Бриккман Юлия Игоревна","field2":"0ac88f7d-4515-11eb-aa35-00155d1a381f","field3":"DimitryukYI@mos.ru"}
,
{"field1":"Брусников Михаил Владимирович","field2":"c0540eef-2982-11f0-b09a-00155d000910","field3":"BrusnikovMV@mos.ru"}
,
{"field1":"Брызгачев Вячеслав Владимирович","field2":"d8cb765d-4ac7-11ed-ace1-00155d000912","field3":"BryzgachevVV@mos.ru"}
,
{"field1":"Булгаков Валентин Николаевич","field2":"d2e96678-438c-11f1-b206-00155d000910","field3":"bulgakovvn1@mos.ru"}
,
{"field1":"Булгакова Анна Игоревна","field2":"e2a5da8c-d2b0-11ed-ad98-00155d000910","field3":"BulgakovaAI@mos.ru"}
,
{"field1":"Булгакова Полина Викторовна","field2":"e1d7e283-be58-11ed-ad7e-00155d000912","field3":"BulgakovaPV@mos.ru"}
,
{"field1":"Булычкина Анна Петровна","field2":"7ce6d857-89ca-11ee-ae86-00155d000912","field3":"BulychkinaAP@mos.ru"}
,
{"field1":"Буркова Алина Андреевна","field2":"f2af5e4a-ad7e-11f0-b144-00155d000912","field3":"burkovaaa@mos.ru"}
,
{"field1":"Бурмистрова Юлия Михайловна","field2":"21dcddc1-2769-11ed-acb3-00155d000912","field3":"BurmistrovaYM@mos.ru"}
,
{"field1":"Буторин Юрий Игоревич","field2":"0b2c756f-ce84-11f0-b170-00155d000912","field3":"butorinyi@mos.ru"}
,
{"field1":"Вавиленкова Ирина Леонидовна","field2":"f431b373-e8b7-11ed-adb4-00155d000912","field3":"VavilenkovaIL1@mos.ru"}
,
{"field1":"Вавилин Павел Александрович","field2":"079a9b79-8b97-11ef-afd2-00155d000912","field3":"VavilinPA@mos.ru"}
,
{"field1":"Валеев Денис Рустамович","field2":"1ec86f36-536e-11ed-acec-00155d000912","field3":"ValeevDR1@mos.ru"}
,
{"field1":"Валимухаметов Юлдаш Рафилевич","field2":"81e1caff-4888-11f1-b20c-00155d000912","field3":"valimukhametovyr@mos.ru"}
,
{"field1":"Валишина Юлия Владимировна","field2":"8e43091d-c3f2-11ee-aed1-00155d000912","field3":"ValishinaYV1@mos.ru"}
,
{"field1":"Ванюшкина Дарья Владимировна","field2":"25bc7ead-584a-11f1-b220-00155d000910","field3":"VanyushkinaDV@it.mos.ru"}
,
{"field1":"Варванин Евгений Николаевич","field2":"1d5c5e96-28b9-11eb-aa10-00155d1a381f","field3":"VarvaninEN@mos.ru"}
,
{"field1":"Василов Владислав Васильевич","field2":"f53eadbe-4781-11f1-b20b-00155d000912","field3":"vasilovvv@mos.ru"}
,
{"field1":"Василова Наталия Владимировна","field2":"81928312-a391-11ed-ad5a-00155d000910","field3":"SinikovaNV@mos.ru"}
,
{"field1":"Васильев Вячеслав Анатольевич","field2":"52a2dedc-7174-11ee-ae67-00155d000910","field3":"VasilevVA18@mos.ru"}
,
{"field1":"Васильева Татьяна Алексеевна","field2":"331cb5d0-87de-11ec-abd2-00155d051a08","field3":"VasilevaTA3@mos.ru"}
,
{"field1":"Ватах Анастасия Александровна","field2":"93b52554-01b3-11ed-ac82-00155d000912","field3":"VatakhAA@mos.ru"}
,
{"field1":"Ватолин Алексей Владиславович","field2":"b95131e1-2987-11f0-b09a-00155d000910","field3":"VatolinAV@mos.ru"}
,
{"field1":"Вежлев Николай Александрович","field2":"2446ddff-8717-11f0-b113-00155d000912","field3":"vezhlevna@mos.ru"}
,
{"field1":"Вельтман Алексей Владиславович","field2":"dbf6c15e-53d9-11ef-af8a-00155d000912","field3":"veltmanav@mos.ru"}
,
{"field1":"Вельтман Кристина Михайловна","field2":"1356a8e3-23d8-11ef-af4d-00155d000912","field3":"VeltmanKM@mos.ru"}
,
{"field1":"Вендеревских Игорь Андреевич","field2":"6cafe9a7-cf0c-11ee-aedf-00155d000910","field3":"venderevskikhia@mos.ru"}
,
{"field1":"Верещагина Елена Игоревна","field2":"6407e54a-2e61-11f1-b1eb-00155d000910","field3":"VereschaginaEI@mos.ru"}
,
{"field1":"Вертунов Арсений Андреевич","field2":"243a43d6-3a9e-11ef-af6a-00155d000912","field3":"vertunovaa@mos.ru"}
,
{"field1":"Вертунова Дарья Андреевна","field2":"f14c2c60-5419-11eb-aa48-00155d1a381f","field3":"VertunovaDD@mos.ru"}
,
{"field1":"Викторова Екатерина Сергеевна","field2":"45013630-0001-11f1-b1af-00155d000912","field3":"viktorovaes2@mos.ru"}
,
{"field1":"Винокурова Анна Алексеевна","field2":"bd49625c-5db6-11f1-b227-00155d000912","field3":"VinokurovaAA4@it.mos.ru"}
,
{"field1":"Витров Тимур Витальевич","field2":"c48005b8-53cb-11ef-af8a-00155d000912","field3":"vitrovtv@mos.ru"}
,
{"field1":"Власова Елена Анатольевна","field2":"87739100-bc48-11ea-a9be-00155d1a381f","field3":"VlasovaEA2@mos.ru"}
,
{"field1":"Власова Татьяна Юрьевна","field2":"d1ace1ee-cbf3-11ee-aedb-00155d000912","field3":"VlasovaTY3@mos.ru"}
,
{"field1":"Волчков Фёдор Олегович","field2":"05f899e8-318a-11f1-b1ef-00155d000912","field3":"volchkovfo@mos.ru"}
,
{"field1":"Воробьев Константин Сергеевич","field2":"fc1b9c55-0492-11f0-b066-00155d000912","field3":"VorobevKS@mos.ru"}
,
{"field1":"Восканянц Наталья Евгеньевна","field2":"56f3a59f-2ce5-11f1-b1e9-00155d000910","field3":"VoskanyantsNE@mos.ru"}
,
{"field1":"Вотякова Елена Васильевна","field2":"80681355-7d32-11ee-ae76-00155d000910","field3":"tokareva1007@gmail.com"}
,
{"field1":"Вронская Кристина Александровна","field2":"5716daca-b37d-11ee-aebc-00155d000912","field3":"VronskayaKA@mos.ru"}
,
{"field1":"Выборнов Андрей Владимирович","field2":"92b2a526-988c-11eb-aaa1-00155d1a381f","field3":"VybornovAV@mos.ru"}
,
{"field1":"Габрусевич Дмитрий Евгеньевич","field2":"72f4b2ef-5c97-11f0-b0dc-00155d000912","field3":"gabrusevichde@mos.ru"}
,
{"field1":"Гаврилова Ирина Александровна","field2":"0b94f924-2103-11f1-b1da-00155d000912","field3":"gavrilovaia2@mos.ru"}
,
{"field1":"Гаврилова Татьяна Владимировна","field2":"b58860ea-d4e4-11ec-ac43-00155d000910","field3":"GavrilovaTV5@mos.ru"}
,
{"field1":"Герасимов Даниил Александрович","field2":"f0b218a6-2c73-11ef-af58-00155d000910","field3":"GerasimovDA2@mos.ru"}
,
{"field1":"Герхенрейдер Римма Михайловна","field2":"67f7ebd4-5725-11f0-b0d5-00155d000912","field3":"GerkhenreyderRM@mos.ru"}
,
{"field1":"Глазкова Ирина Дмитриевна","field2":"c5fd15b2-6441-11ef-af9f-00155d000910","field3":"GlazkovaID@mos.ru"}
,
{"field1":"Глазкова Софья Олеговна","field2":"dd70c9de-f005-11ee-af0b-00155d000912","field3":"GlazkovaSO@mos.ru"}
,
{"field1":"Гоголь Яна Сергеевна","field2":"f1cfb2b6-8c82-11f0-b11a-00155d000912","field3":"gogolys@mos.ru"}
,
{"field1":"Голикова Мария Владимировна","field2":"7da1c38a-8839-11ee-ae84-00155d000910","field3":"GolikovaMV3@mos.ru"}
,
{"field1":"Головченко Вера Валерьевна","field2":"740f99cc-1736-11ee-adf1-00155d000910","field3":"GolovchenkoVV@mos.ru"}
,
{"field1":"Горбунов Владимир Сергеевич","field2":"297e55ea-ce97-11f0-b170-00155d000912","field3":"gorbunovvs1@mos.ru"}
,
{"field1":"Гордиенко Андрей Анатольевич","field2":"e9c63013-7ef9-11ef-afc2-00155d000910","field3":"GordienkoAA4@mos.ru"}
,
{"field1":"Горячев Иван Александрович","field2":"a519a6ea-3d4a-11f0-b0b4-00155d000912","field3":"goryachevia@mos.ru"}
,
{"field1":"Грачев Борис Владимирович","field2":"016f4941-08c3-11ed-ac8b-00155d000910","field3":"GrachevBV@mos.ru"}
,
{"field1":"Григорьева Алина Сергеевна","field2":"da8ca54c-478b-11f1-b20b-00155d000912","field3":"grigorevaas6@mos.ru"}
,
{"field1":"Грошева Анастасия Владимировна","field2":"18e4c60e-2845-11f1-b1e3-00155d000912","field3":"GroshevaAV2@mos.ru"}
,
{"field1":"Грыжина Елена Юрьевна","field2":"69abd16b-ee1b-11eb-ab0d-00155d051a08","field3":"GryzhinaEY@mos.ru"}
,
{"field1":"Губарева Алёна Павловна","field2":"ad15fa76-7995-11ef-afbb-00155d000912","field3":"gubarevaap1@mos.ru"}
,
{"field1":"Гузенин Руслан Олегович","field2":"724bcf07-0f92-11f0-b074-00155d000910","field3":"GuzeninRO@mos.ru"}
,
{"field1":"Гюлер Ксения Николаевна","field2":"fa999387-44f0-11eb-aa35-00155d1a381f","field3":"GyulerKN@mos.ru"}
,
{"field1":"Давыдова Дина Антоновна","field2":"d39b6304-be0a-11f0-b159-00155d000912","field3":"davydovada4@mos.ru"}
,
{"field1":"Давыдова Юлия Михайловна","field2":"048bcdb6-eee3-11f0-b199-00155d000910","field3":"davydovaym2@mos.ru"}
,
{"field1":"Данилова Мария Викторовна","field2":"4f22aa4d-4f5e-11ef-af84-00155d000910","field3":"ryabovamv3@mos.ru"}
,
{"field1":"Дворецкая Нина Викторовна","field2":"9b484d49-27cd-11ef-af52-00155d000910","field3":"DvoretskayaNV1@mos.ru"}
,
{"field1":"Дворников Георгий Витальевич","field2":"78c1f69e-48ff-11eb-aa3a-00155d1a381f","field3":"DvornikovGV1@mos.ru"}
,
{"field1":"Демидик Ольга Анатольевна","field2":"3fc89bc4-851c-11ee-ae80-00155d000912","field3":"DemidikOA@mos.ru"}
,
{"field1":"Демидова Евгения Анатольевна","field2":"30bb9a88-2839-11f1-b1e3-00155d000912","field3":"DemidovaEA3@mos.ru"}
,
{"field1":"Дербенева Алена Игоревна","field2":"8c28a49f-f577-11ee-af12-00155d000910","field3":"DerbenevaAI@mos.ru"}
,
{"field1":"Дергачева Анна Вячеславовна","field2":"f1bf1f5d-c170-11ed-ad82-00155d000910","field3":"dergachevaav@mos.ru"}
,
{"field1":"Добротворская Анастасия Александровна","field2":"bc82d784-4329-11ed-acd7-00155d000912","field3":"DobrotvorskayaAA1@mos.ru"}
,
{"field1":"Долганова Татьяна Валерьевна","field2":"1babb84e-cf4a-11f0-b171-00155d000912","field3":"dolganovatv@mos.ru"}
,
{"field1":"Дочвири Ираклий Александрович","field2":"25c629c2-b146-11ef-b002-00155d000912","field3":"dochviriia@mos.ru"}
,
{"field1":"Дрозд Ольга Андреевна","field2":"5ffb2293-0007-11f1-b1af-00155d000912","field3":"drozdoa@mos.ru"}
,
{"field1":"Егоренкова Анна Дмитриевна","field2":"138993e5-4a50-11ef-af7e-00155d000912","field3":"egorenkovaad@mos.ru"}
,
{"field1":"Егоров Валерий Игоревич","field2":"904dd76b-efcc-11ed-adbd-00155d000912","field3":"EgorovVI8@mos.ru"}
,
{"field1":"Елисеева Галина Владимировна","field2":"12a524b0-0fb2-11ec-ab38-00155d051a08","field3":"EliseevaGV@mos.ru"}
,
{"field1":"Ёлкин Георгий Владимирович","field2":"0dbe8b16-a20a-11ed-ad58-00155d000910","field3":"ElkinGV@mos.ru"}
,
{"field1":"Елфимова Анастасия Ивановна","field2":"f3931266-379e-11f0-b0ad-00155d000910","field3":"ElfimovaAI@mos.ru"}
,
{"field1":"Емелин Владимир Владимирович","field2":"e717d994-5b0e-11f0-b0da-00155d000910","field3":"emelinvv1@mos.ru"}
,
{"field1":"Ергакова Мария Андреевна","field2":"e2cbfff1-2042-11ec-ab4d-00155d051a08","field3":"klukvik5@mail.ru"}
,
{"field1":"Ерёмина Екатерина Владимировна","field2":"d040603f-71e8-11ec-abb6-00155d051a08","field3":"EreminaEV4@mos.ru"}
,
{"field1":"Ермаков Глеб Денисович","field2":"e4efb689-b300-11f0-b14b-00155d000910","field3":"ermakovgd@mos.ru"}
,
{"field1":"Ермолаев Михаил Николаевич","field2":"4014a907-98e5-11ef-afe3-00155d000910","field3":"ErmolaevMN@mos.ru"}
,
{"field1":"Ефимов Александр Игоревич","field2":"350b9d2d-b088-11ef-b001-00155d000910","field3":"EfimovAI3@mos.ru"}
,
{"field1":"Ефимов Сергей Юрьевич","field2":"15c8b8db-16c6-11f1-b1cc-00155d000912","field3":"efimovsy5@mos.ru"}
,
{"field1":"Жабовская Екатерина Андреевна","field2":"c0626ac3-5800-11f1-b220-00155d000910","field3":"ZhabovskayaEA@mos.ru"}
,
{"field1":"Жуков Андрей Сергеевич","field2":"f187d66e-b304-11f0-b14b-00155d000910","field3":"zhukovas11@mos.ru"}
,
{"field1":"Загарина Ирина Николаевна","field2":"16e06857-817d-11f0-b10c-00155d000912","field3":"zagarinain@mos.ru"}
,
{"field1":"Заграничный Дмитрий Павлович","field2":"1935f0ce-47f7-11ef-af7b-00155d000910","field3":"zagranichnyydp@mos.ru"}
,
{"field1":"Зайкова Ксения Викторовна","field2":"1725ba17-d44c-11ed-ad9a-00155d000910","field3":"ZaikovaKV@mos.ru"}
,
{"field1":"Зайцева Маргарита Юрьевна","field2":"a54b37fb-0115-11ee-add3-00155d000912","field3":"margosha7173@mail.ru"}
,
{"field1":"Заренкова Анфиса","field2":"1298e737-31b6-11f1-b1ef-00155d000912","field3":"ZarenkovaA@mos.ru"}
,
{"field1":"Захарчук Алиса Сергеевна","field2":"f10c51d3-cca3-11ee-aedc-00155d000912","field3":"ZakharchukAS@mos.ru"}
,
{"field1":"Зеленов Александр Аркадьевич","field2":"221317a4-6fb5-11ed-ad11-00155d000912","field3":"ZelenovAA@mos.ru"}
,
{"field1":"Зеленов Александр Аркадьевич","field2":"79ef6a35-d405-11f0-b177-00155d000912","field3":"ZelenovAA@mos.ru"}
,
{"field1":"Зимин Сергей Юрьевич","field2":"51f7be49-e14c-11ea-a9ca-00155d1a381f","field3":"ZiminSY@mos.ru"}
,
{"field1":"Злобина Светлана Анатольевна","field2":"7569eb11-4275-11ef-af74-00155d000912","field3":"zlobinasa@mos.ru"}
,
{"field1":"Золотарев Александр Викторович","field2":"0e3f12a7-2847-11f1-b1e3-00155d000912","field3":"zolotarevav4@mos.ru"}
,
{"field1":"Зотова Надежда Валерьевна","field2":"c3bbd52f-4772-11ec-ab7f-00155d051a08","field3":"ZotovaNV@mos.ru"}
,
{"field1":"Зубатова Дарья Витальевна","field2":"ca93b190-2011-11f0-b08e-00155d000912","field3":"ZubatovaDV@mos.ru"}
,
{"field1":"Зуев Дмитрий Сергеевич","field2":"f79f89ff-dfe6-11ec-ac53-00155d000912","field3":"ZuevDS@mos.ru"}
,
{"field1":"Ибраимова Лейла Эскендеровна","field2":"ec0a9640-2da1-11f1-b1ea-00155d000910","field3":"IbraimovaLE@mos.ru"}
,
{"field1":"Иванова Светлана Георгиевна","field2":"d06e6334-bd28-11eb-aad0-00155d1a381f","field3":"IvanovaSG5@mos.ru"}
,
{"field1":"Изоткин Александр Геннадьевич","field2":"46564cc6-1129-11f0-b076-00155d000912","field3":"IzotkinAG@mos.ru"}
,
{"field1":"Изотова Евгения Сергеевна","field2":"974dced0-6827-11ea-a9a2-00155d1a230c","field3":"IzotovaES@mos.ru"}
,
{"field1":"Илдис Алина Александровна","field2":"9d72c33f-0d67-11f1-b1c0-00155d000910","field3":"ildisaa@mos.ru"}
,
{"field1":"Казакова Алина Александровна","field2":"acbc2fa7-5000-11f0-b0cc-00155d000910","field3":"kazakovaaa3@mos.ru"}
,
{"field1":"Казанцев Артем Евгеньевич","field2":"e95f3040-e56f-11ec-ac5c-00155d000912","field3":"KazantsevAE@mos.ru"}
,
{"field1":"Калашников Алексей Юрьевич","field2":"82c59175-d2c1-11ed-ad98-00155d000910","field3":"kalashnikovay3@mos.ru"}
,
{"field1":"Каленкин Роман Николаевич","field2":"ec7a068b-635c-11ee-ae55-00155d000910","field3":"KalenkinRN@mos.ru"}
,
{"field1":"Калинушкин Максим Владимирович","field2":"7454c04a-47fc-11ef-af7b-00155d000910","field3":"kalinushkinmv@mos.ru"}
,
{"field1":"Калистратов Илья Алексеевич","field2":"f2f3e445-d59a-11f0-b179-00155d000912","field3":"KalistratovIA1@mos.ru"}
,
{"field1":"Каллаур Ольга Юрьевна","field2":"1c4c337e-a8d3-11f0-b13e-00155d000910","field3":"olkallaur@mail.ru"}
,
{"field1":"Калугин Иван Анатольевич","field2":"12014990-b07b-11ef-b001-00155d000910","field3":"KaluginIA@mos.ru"}
,
{"field1":"Кандыба Дарья Дмитриевна","field2":"e598df3f-8702-11f0-b113-00155d000912","field3":"kandybadd@mos.ru"}
,
{"field1":"Кардаполова Татьяна Алексеевна","field2":"37f5f189-9846-11f0-b129-00155d000912","field3":"kardapolovata@mos.ru"}
,
{"field1":"Каревская Анна Андреевна","field2":"37fcf7f1-4045-11f0-b0b8-00155d000910","field3":"karevskayaaa@mos.ru"}
,
{"field1":"Кармацкий Илья Анатольевич","field2":"b524be47-fd78-11ef-b05d-00155d000912","field3":"karmatskiyia@mos.ru"}
,
{"field1":"Картузов Илья Евгеньевич","field2":"acaa8afc-c06a-11f0-b15c-00155d000912","field3":"kartuzovie@mos.ru"}
,
{"field1":"Касаткин Алексей Вячеславович","field2":"23fe92dc-e316-11eb-aaff-00155d051a08","field3":"KasatkinAV@mos.ru"}
,
{"field1":"Касаткин Алексей Вячеславович","field2":"612b8ab3-33eb-11f1-b1f2-00155d000912","field3":"KasatkinAV@mos.ru"}
,
{"field1":"Касницкая Виктория Николаевна","field2":"5f3c4cc1-0b00-11f1-b1bd-00155d000912","field3":"kasnitskayavn@mos.ru"}
,
{"field1":"Кастрова Анна Владимировна","field2":"f52656dd-2ce6-11ed-acbb-00155d000910","field3":"kastrovaav@mos.ru"}
,
{"field1":"Каткова Елена Дмитриевна","field2":"c1240b8d-3032-11ee-ae13-00155d000912","field3":"KatkovaED@mos.ru"}
,
{"field1":"Киреева Анна Викторовна","field2":"0bdcc970-7889-11ee-ae70-00155d000912","field3":"KireevaAV4@mos.ru"}
,
{"field1":"Киреева Дарина Сергеевна","field2":"2e73321e-d831-11ed-ad9f-00155d000912","field3":"KireevaDS@mos.ru"}
,
{"field1":"Кислякова Ольга Васильевна","field2":"24f3fe59-9a4c-11ee-ae9c-00155d000912","field3":"KislyakovaOV@mos.ru"}
,
{"field1":"Клишина Виктория Павловна","field2":"9d3ff22d-0919-11ef-af2b-00155d000910","field3":"KlishinaVP@mos.ru"}
,
{"field1":"Клушина Елена Валентиновна","field2":"afd0e5ab-76fb-11ee-ae6e-00155d000912","field3":"KlushinaEV2@mos.ru"}
,
{"field1":"Клюкина Дарья Сергеевна","field2":"36ce3059-2843-11f1-b1e3-00155d000912","field3":"KlyukinaDS@mos.ru"}
,
{"field1":"Князев Андрей Дмитриевич","field2":"7f93f20d-e107-11ee-aef8-00155d000910","field3":"KnyazevAD3@mos.ru"}
,
{"field1":"Князева Елена Геннадьевна","field2":"eba41dd9-219b-11f0-b090-00155d000912","field3":"KnyazevaEG3@mos.ru"}
,
{"field1":"Ковалев Никита Александрович","field2":"fd2367a4-a1fe-11ed-ad58-00155d000910","field3":"KovalevNA@mos.ru"}
,
{"field1":"Коваленко Артём Андреевич","field2":"8880d308-0854-11ef-af2a-00155d000912","field3":"KovalenkoAA2@mos.ru"}
,
{"field1":"Коваленко Ксения Васильевна","field2":"196e3c96-9aec-11ed-ad4f-00155d000910","field3":"KovalenkoKV@mos.ru"}
,
{"field1":"Коваленко Мария Алексеевна","field2":"f29c6826-c3ff-11ee-aed1-00155d000912","field3":"KovalenkoMA@mos.ru"}
,
{"field1":"Ковтуненко Антон Александрович","field2":"07a202ec-714b-11ed-ad13-00155d000910","field3":"KovtunenkoAA@mos.ru"}
,
{"field1":"Козлова Диана Анатольевна","field2":"7d229a3f-15f8-11ec-ab40-00155d051a08","field3":"KozlovaDA2@mos.ru"}
,
{"field1":"Кокорева Ирина Александровна","field2":"516e3782-5fb7-11eb-aa59-00155d1a381f","field3":"KokorevaIA1@mos.ru"}
,
{"field1":"Колбасова Инна Олеговна","field2":"aff6a2e1-6c51-11f0-b0f1-00155d000910","field3":"kolbasovaio@mos.ru"}
,
{"field1":"Колесникова Анна Аркадьевна","field2":"77151f75-e2c4-11ef-b042-00155d000912","field3":"kolesnikovaaa3@mos.ru"}
,
{"field1":"Колесникова Елизавета Константиновна","field2":"48f25a5b-f001-11ee-af0b-00155d000912","field3":"KolesnikovaEK1@mos.ru"}
,
{"field1":"Колокольцев Сергей Дмитриевич","field2":"efc7280b-1287-11ef-af37-00155d000910","field3":"KolokoltsevSD@mos.ru"}
,
{"field1":"Коломарь Елена Алексеевна","field2":"4bb6f055-29c3-11ed-acb6-00155d000912","field3":"KolomarEA@mos.ru"}
,
{"field1":"Колюканова Марина Анатольевна","field2":"2b59f647-e121-11ea-a9ca-00155d1a381f","field3":"KolyukanovaMA@mos.ru"}
,
{"field1":"Комарова Елена Сергеевна","field2":"92c0fb89-3a71-11ee-ae20-00155d000910","field3":"KomarovaES5@mos.ru"}
,
{"field1":"Комиссарова Анастасия Алексеевна","field2":"7458f3cc-eff4-11ee-af0b-00155d000912","field3":"KomissarovaAA5@mos.ru"}
,
{"field1":"Кононова Елизавета Дмитриевна","field2":"43f0e408-2f41-11ed-acbe-00155d000912","field3":"KononovaED@mos.ru"}
,
{"field1":"Коняева Ксения Сергеевна","field2":"7524c1fe-283b-11f1-b1e3-00155d000912","field3":"KonyaevaKS@mos.ru"}
,
{"field1":"Копа Кристина Дмитриевна","field2":"66457c6c-60db-11f1-b22b-00155d000912","field3":""}
,
{"field1":"Коптилкина Ирина Сергеевна","field2":"964c9246-d15a-11ee-aee2-00155d000910","field3":"KoptilkinaIS@mos.ru"}
,
{"field1":"Копцева Кристина Алексеевна","field2":"dda688e8-283e-11f1-b1e3-00155d000912","field3":"KoptsevaKA@mos.ru"}
,
{"field1":"Кораблина Ирина Анатольевна","field2":"d9b9428f-a15a-11ed-ad57-00155d000912","field3":"KorablinaIA@mos.ru"}
,
{"field1":"Коренькова Анастасия Анатольевна","field2":"f6cff9d1-428e-11ef-af74-00155d000912","field3":"korenkovaaa@mos.ru"}
,
{"field1":"Королев Андрей Александрович","field2":"6cd85ea8-1e82-11f0-b08c-00155d000910","field3":"KorolevAA1@mos.ru"}
,
{"field1":"Королева Ирина Андреевна","field2":"a0baed50-2839-11f1-b1e3-00155d000912","field3":"KorolevaIA13@mos.ru"}
,
{"field1":"Королева Ксения Сергеевна","field2":"6e402800-bba4-11f0-b156-00155d000910","field3":"korolevaks1@mos.ru"}
,
{"field1":"Корхов Александр Вадимович","field2":"b1c9e4b8-faf8-11ee-af19-00155d000912","field3":"korkhovav1@mos.ru"}
,
{"field1":"Косарева Татьяна Константиновна","field2":"2a3d7d74-0ae5-11f0-b06e-00155d000912","field3":"KosarevaTK3@mos.ru"}
,
{"field1":"Косолобенкова Ирина Александровна","field2":"1ebd4e56-ea10-11f0-b193-00155d000910","field3":"KosolobenkovaIA@mos.ru"}
,
{"field1":"Косьянова Карина Максимовна","field2":"e5b6ffc8-b3b5-11ee-aebc-00155d000912","field3":"KosyanovaKM@mos.ru"}
,
{"field1":"Котельникова Марина Борисовна","field2":"26504bd4-c201-11eb-aad6-00155d1a381f","field3":"KotelnikovaMB@mos.ru"}
,
{"field1":"Краморенко Анна Матвеевна","field2":"031c5d46-6999-11ee-ae5d-00155d000912","field3":"KramorenkoAM@mos.ru"}
,
{"field1":"Краснов Филипп Евгеньевич","field2":"b12396be-5dff-11ef-af97-00155d000912","field3":"krasnovfe@mos.ru"}
,
{"field1":"Кривчанская Екатерина Михайловна","field2":"ae226e0d-6374-11ef-af9e-00155d000912","field3":"KrivchanskayaEM@mos.ru"}
,
{"field1":"Кротова Наталья Андреевна","field2":"3fc7ffdd-0bca-11f1-b1be-00155d000912","field3":"krotovana4@mos.ru"}
,
{"field1":"Круглов Денис Максимович","field2":"24dc1697-bbef-11ed-ad7b-00155d000910","field3":"kruglovdm@mos.ru"}
,
{"field1":"Круглов Денис Максимович","field2":"d8f5f0ab-f22b-11f0-b19d-00155d000910","field3":"kruglovdm@mos.ru"}
,
{"field1":"Круглова Наталья Геннадьевна","field2":"ed0d64e9-452f-11eb-aa35-00155d1a381f","field3":"KruglovaNG@mos.ru"}
,
{"field1":"Крюков Андрей Александрович","field2":"1c0b8fea-7154-11ed-ad13-00155d000910","field3":"KryukovAA3@mos.ru"}
,
{"field1":"Крючкова Варвара Александровна","field2":"6bc25b8b-d17b-11ef-b02b-00155d000910","field3":"kryuchkovava3@mos.ru"}
,
{"field1":"Кузина Анастасия Дмитриевна","field2":"a0b22568-797e-11ef-afbb-00155d000912","field3":"KuzinaAD1@mos.ru"}
,
{"field1":"Кузнецова Валерия Сергеевна","field2":"19dadd6c-3039-11ee-ae13-00155d000912","field3":"kuznetsovavs5@mos.ru"}
,
{"field1":"Кузькина Полина Геннадьевна","field2":"fffb5e42-1a39-11ee-adf7-00155d000910","field3":"KuzkinaPG@mos.ru"}
,
{"field1":"Кузьмичева Василиса Владимировна","field2":"1f9ee891-86fd-11f0-b113-00155d000912","field3":"vasilisa88@yahoo.com"}
,
{"field1":"Куклина Екатерина Сергеевна","field2":"d30350df-27bf-11ef-af52-00155d000910","field3":"KuklinaES1@mos.ru"}
,
{"field1":"Кукушкин Данила Владимирович","field2":"cf2adf63-bee5-11ec-ac18-00155d051a08","field3":"KukushkinDV@mos.ru"}
,
{"field1":"Куприянова Елена Геннадьевна","field2":"5cb833f0-2836-11f1-b1e3-00155d000912","field3":"KupriyanovaEG@mos.ru"}
,
{"field1":"Купцов Владимир Сергеевич","field2":"340fed1e-9b43-11ef-afe6-00155d000910","field3":"KuptsovVS1@mos.ru"}
,
{"field1":"Курачева Ольга Александровна","field2":"4a86071b-8a02-11ef-afd0-00155d000912","field3":"KurachevaOA@mos.ru"}
,
{"field1":"Курджиева Марина Филаловна","field2":"17367350-d09e-11ee-aee1-00155d000910","field3":"KurdzhievaMF@mos.ru"}
,
{"field1":"Курмаева Валерия Юрьевна","field2":"f2d0e43e-4c87-11ee-ae38-00155d000910","field3":"KurmaevaVY@mos.ru"}
,
{"field1":"Курнакин Дмитрий Андреевич","field2":"78ae9ca3-ae91-11ed-ad6a-00155d000912","field3":"KurnakinDA@mos.ru"}
,
{"field1":"Куршев Никита Владиславович","field2":"a509107e-12fa-11ed-ac98-00155d000912","field3":"KurshevNV@mos.ru"}
,
{"field1":"Кутузова Ирина Алексеевна","field2":"85ae946a-e77d-11ef-b046-00155d000910","field3":"kutuzovaia1@mos.ru"}
,
{"field1":"Кутырева Наталья Валерьевна","field2":"5ebcf8d2-7701-11ee-ae6e-00155d000912","field3":"KutyrevaNV1@mos.ru"}
,
{"field1":"Кучкильдин Андрей Анварович","field2":"8a505415-a9ac-11ec-abfd-00155d051a08","field3":"KuchkildinAA@mos.ru"}
,
{"field1":"Кушева Мария Юрьевна","field2":"4b8867f8-fbb9-11ee-af1a-00155d000912","field3":"kushevamy@mos.ru"}
,
{"field1":"Кушнеревич Олеся Леонидовна","field2":"34aaf005-00cb-11f1-b1b0-00155d000910","field3":"kushnerevichol@mos.ru"}
,
{"field1":"Лазарев Рафаэль Владимирович","field2":"923e7c66-16a3-11f0-b082-00155d000912","field3":"lazarevrv@mos.ru"}
,
{"field1":"Ланин Герман Александрович","field2":"c89ff32c-73e3-11ea-a9a7-00155d1a230c","field3":"LaninGA@mos.ru"}
,
{"field1":"Ларина Валерия Николаевна","field2":"a0438c9a-d470-11ee-aee6-00155d000912","field3":"LarinaVN@mos.ru"}
,
{"field1":"Лёвкина Евгения Сергеевна","field2":"d24a2204-2902-11f1-b1e4-00155d000910","field3":"LevkinaES@mos.ru"}
,
{"field1":"Лесюк Георгий Андреевич","field2":"e575af0a-e4f1-11ee-aefd-00155d000912","field3":"LesyukGA@mos.ru"}
,
{"field1":"Липс Евгения Геннадьевна","field2":"f5f9ce86-d840-11ed-ad9f-00155d000912","field3":"LipsEG@it.mos.ru"}
,
{"field1":"Лисовская Екатерина Михайловна","field2":"858bdab5-1846-11eb-a9fb-00155d1a381f","field3":"LisovskayaEM@mos.ru"}
,
{"field1":"Литвинова Мария Валерьевна","field2":"c9c5b757-5e50-11f1-b228-00155d000912","field3":"litvinovamv1@mos.ru"}
,
{"field1":"Литвинова Полина Григорьевна","field2":"f6531d5f-2839-11f1-b1e3-00155d000912","field3":"LitvinovaPG@mos.ru"}
,
{"field1":"Лозовская Светлана Францевна","field2":"f4c600bc-f0be-11ee-af0c-00155d000912","field3":"LozovskayaSF@mos.ru"}
,
{"field1":"Лошкарева Ирина Анатольевна","field2":"dc4c0e4d-2e14-11ef-af5a-00155d000910","field3":"loshkarevaia@mos.ru"}
,
{"field1":"Лукашенко Михаил Алексеевич","field2":"43ed845e-ecff-11ef-b048-00155d000912","field3":"lukashenkoma@mos.ru"}
,
{"field1":"Лукина Юлия Анатольевна","field2":"858ee4bf-7740-11ef-afb8-00155d000912","field3":"LukinaYA4@mos.ru"}
,
{"field1":"Лукоянов Алексей Александрович","field2":"c6d9a753-071b-11f1-b1b8-00155d000910","field3":"lukoyanovaa1@mos.ru"}
,
{"field1":"Лукьянова Ирина Павловна","field2":"28f82a1a-787f-11ee-ae70-00155d000912","field3":"LukyanovaIP@mos.ru"}
,
{"field1":"Луньков Александр Валерьевич","field2":"cbd82977-0ecc-11f0-b073-00155d000910","field3":"lunkovav1@mos.ru"}
,
{"field1":"Львов Юрий Владимирович","field2":"19336669-68ad-11ec-abaa-00155d051a08","field3":"lvoff42@gmail.com"}
,
{"field1":"Любавина Елена Владимировна","field2":"7ab02b22-f8cd-11ef-b057-00155d000912","field3":"LyubavinaEV@mos.ru"}
,
{"field1":"Лявинец Евгений Михайлович","field2":"c3992bfb-cb73-11ec-ac28-00155d051a08","field3":"LyavinetsEM@mos.ru"}
,
{"field1":"Мазуров Виталий Александрович","field2":"293f94a4-dd72-11eb-aaf8-00155d051a08","field3":"MazurovVA@mos.ru"}
,
{"field1":"Мазуров Михаил Петрович","field2":"6cbb4ea2-a141-11ed-ad57-00155d000912","field3":"MazurovMP@mos.ru"}
,
{"field1":"Май Екатерина Алексеевна","field2":"a5827475-2846-11f1-b1e3-00155d000912","field3":"may.ekaterina.88@gmail.com"}
,
{"field1":"Макаров Геннадий Валерьевич","field2":"01b71a82-452f-11eb-aa35-00155d1a381f","field3":"MakarovGV@mos.ru"}
,
{"field1":"Макеева Елена Александровна","field2":"196219e4-d3d1-11e9-a994-00155d1a3432","field3":"MakeevaEA@mos.ru"}
,
{"field1":"Маковецкая Софья Вячеславовна","field2":"6b284577-0b25-11ec-ab32-00155d051a08","field3":"MakovetskayaSV@mos.ru"}
,
{"field1":"Максимова Ольга Владимировна","field2":"b9270628-d4e3-11ec-ac43-00155d000910","field3":"MaksimovaOV9@mos.ru"}
,
{"field1":"Маликова Ольга Сергеевна","field2":"69db2b3a-347b-11f0-b0a9-00155d000912","field3":"MalikovaOS@mos.ru"}
,
{"field1":"Малофеев Иван Юрьевич","field2":"a957daac-7aba-11ed-ad1f-00155d000910","field3":"MalofeevIY@mos.ru"}
,
{"field1":"Малышева Дарья Григорьевна","field2":"6a0877b4-4f5e-11ef-af84-00155d000910","field3":"MalyshevaDG@mos.ru"}
,
{"field1":"Манафова Фидан Рауфовна","field2":"1837d110-e205-11ef-b041-00155d000910","field3":"ManafovaFR@mos.ru"}
,
{"field1":"Мансуров Ришат Ахшантуевич","field2":"de195971-856a-11ef-afca-00155d000910","field3":"mansurovra@mos.ru"}
,
{"field1":"Мартынов Лев Александрович","field2":"accb9ef3-3843-11ef-af67-00155d000912","field3":"YudkinLA@mos.ru"}
,
{"field1":"Марусов Дмитрий Александрович","field2":"67aa2016-b171-11ea-a9b7-00155d1a2829","field3":"MarusovDA@mos.ru"}
,
{"field1":"Масалитина Алла Михайловна","field2":"0603082f-89fc-11ef-afd0-00155d000912","field3":"MasalitinaAM@mos.ru"}
,
{"field1":"Маслова Анастасия Ивановна","field2":"317390f3-4aa7-11f1-b20f-00155d000912","field3":"maslovaai2@mos.ru"}
,
{"field1":"Масловская Анна Андреевна","field2":"9185c334-fb63-11ec-ac7a-00155d000912","field3":"MaslovskayaAA1@mos.ru"}
,
{"field1":"Матвеев Борис Николаевич","field2":"50153bc9-379c-11ef-af66-00155d000910","field3":"MatveevBN@mos.ru"}
,
{"field1":"Матвеева Инна Александровна","field2":"7e84820e-2842-11f1-b1e3-00155d000912","field3":"MatveevaIA3@mos.ru"}
,
{"field1":"Машошин Евгений Геннадьевич","field2":"522b0c61-429c-11ef-af74-00155d000912","field3":"mashoshineg@mos.ru"}
,
{"field1":"Медведев Сергей Владиславович","field2":"35e97c60-795c-11ee-ae71-00155d000910","field3":"MedvedevSV6@mos.ru"}
,
{"field1":"Медников Руслан Владимирович","field2":"f1c3529a-a213-11ed-ad58-00155d000910","field3":"MednikovRV@mos.ru"}
,
{"field1":"Межиев Магомед Заурбекович","field2":"8553b16e-2a6e-11ec-ab5a-00155d051a08","field3":"MezhievMZ@mos.ru"}
,
{"field1":"Мелешков Сергей Олегович","field2":"73b515aa-b0ee-11ed-ad6d-00155d000912","field3":"MeleshkovSO@mos.ru"}
,
{"field1":"Мельниченко Наталья Сергеевна","field2":"43d219fc-c900-11f0-b167-00155d000912","field3":"melnichenkons1@mos.ru"}
,
{"field1":"Мечетин Алексей Васильевич","field2":"74cad695-5889-11ef-af90-00155d000912","field3":"MechetinAV@mos.ru"}
,
{"field1":"Мещерякова Наталия Игоревна","field2":"4ee0318a-2838-11f1-b1e3-00155d000912","field3":"mescheryakovani2@mos.ru"}
,
{"field1":"Милянцевич Марина Андреевна","field2":"15e45182-68f6-11ef-afa5-00155d000910","field3":"MilyantsevichMA@mos.ru"}
,
{"field1":"Миронов Андрей Иванович","field2":"2bc06777-7fc5-11ef-afc3-00155d000912","field3":"MironovAI5@mos.ru"}
,
{"field1":"Мифтахова Альбина Ильгизовна","field2":"f9b0aeb3-599d-11f1-b222-00155d000912","field3":"miftakhovaai@it.mos.ru"}
,
{"field1":"Михайлов Александр Сергеевич","field2":"3b2f519d-3908-11ef-af68-00155d000912","field3":"MikhaylovAS4@mos.ru"}
,
{"field1":"Михайлова Анастасия Александровна","field2":"e90fc508-7e07-11ee-ae77-00155d000912","field3":"mikhaylova.anastasia.2004@mail.ru"}
,
{"field1":"Михеев Денис Александрович","field2":"3db60382-aebe-11ee-aeb6-00155d000912","field3":"MikheevDA5@mos.ru"}
,
{"field1":"Михейкина Наталья Анатольевна","field2":"85915079-a361-11ec-abf5-00155d051a08","field3":"MikheykinaNA@mos.ru"}
,
{"field1":"Мкртчян Мария Тиграновна","field2":"d7ac7ccb-4b64-11ec-ab84-00155d051a08","field3":"MkrtchyanMT@mos.ru"}
,
{"field1":"Молочкова Наталья Александровна","field2":"67f91578-b1cf-11ed-ad6e-00155d000912","field3":"MolochkovaNA@mos.ru"}
,
{"field1":"Монастырский Евгений Сергеевич","field2":"113cb516-db42-11ec-ac4d-00155d000912","field3":"MonastyrskiyES@mos.ru"}
,
{"field1":"Морозова Нина Юрьевна","field2":"09be8e0e-c239-11ed-ad83-00155d000912","field3":"morozovany5@mos.ru"}
,
{"field1":"Мостовая Олеся Юрьевна","field2":"843e5df1-2903-11f1-b1e4-00155d000910","field3":"MostovayaOY@mos.ru"}
,
{"field1":"Мохна Юрий Николаевич","field2":"2db1df4f-4f5e-11ef-af84-00155d000910","field3":"MokhnaYN1@mos.ru"}
,
{"field1":"Мохова Елена Дмитриевна","field2":"7845e8f3-c461-11ef-b01a-00155d000912","field3":"MokhovaED@mos.ru"}
,
{"field1":"Мурашевская Татьяна Владимировна","field2":"09abed97-1846-11eb-a9fb-00155d1a381f","field3":"MurashevskayaTV@mos.ru"}
,
{"field1":"Назарова Александра Витальевна","field2":"3533f578-ea8c-11e9-a996-00155d1a3432","field3":"KorolevaAV1@mos.ru"}
,
{"field1":"Настасюк Евгений Владимирович","field2":"ae018724-0411-11ec-ab29-00155d051a08","field3":"NastasyukEV@mos.ru"}
,
{"field1":"Натыкина Елена Васильевна","field2":"1dd4c906-cc98-11ee-aedc-00155d000912","field3":"NatykinaEV@mos.ru"}
,
{"field1":"Невзоров Алексей Александрович","field2":"027cd2ef-46b0-11f0-b0c0-00155d000910","field3":"nevzorovaa2@mos.ru"}
,
{"field1":"Невзорова Екатерина Петровна","field2":"55e67734-69dd-11eb-aa66-00155d1a381f","field3":"nevzorovaep1@mos.ru"}
,
{"field1":"Неганов Дмитрий Андреевич","field2":"f03fe76a-fa8b-11f0-b1a8-00155d000910","field3":"neganovda1@mos.ru"}
,
{"field1":"Нефедов Александр Игоревич","field2":"9f54ad7f-c5f3-11ec-ac21-00155d051a08","field3":"NefedovAI@mos.ru"}
,
{"field1":"Нефедова Анна Викторовна","field2":"25273945-a1a8-11eb-aaad-00155d1a381f","field3":"NefedovaAV1@mos.ru"}
,
{"field1":"Нехлопочина Инна Сергеевна","field2":"341bb5b8-650e-11ef-afa0-00155d000912","field3":"nekhlopochinais@mos.ru"}
,
{"field1":"Никанорова Мария Максимовна","field2":"8028cb97-1963-11ed-aca1-00155d000912","field3":"NikanorovaMM@mos.ru"}
,
{"field1":"Никитина Ксения Владимировна","field2":"4c1f6803-5e93-11f1-b228-00155d000912","field3":"NikitinaKV4@it.mos.ru"}
,
{"field1":"Никитченко Илья Андреевич","field2":"3b28b49b-68f8-11ef-afa5-00155d000910","field3":"NikitchenkoIA@mos.ru"}
,
{"field1":"Нилов Илья Николаевич","field2":"045ad09d-5ffe-11ed-acfc-00155d000910","field3":"ilyanilov1987@gmail.com"}
,
{"field1":"Новицкая Владислава Андреевна","field2":"77d184cd-8632-11ef-afcb-00155d000910","field3":"novitskayava1@mos.ru"}
,
{"field1":"Носачева Анна Андреевна","field2":"a658b016-3a01-11f0-b0b0-00155d000910","field3":"NosachevaAA@mos.ru"}
,
{"field1":"Носкова Екатерина Евгеньевна","field2":"b7ed420b-d6d1-11ee-aee9-00155d000912","field3":"ulybinaee@mos.ru"}
,
{"field1":"Оболенская Татьяна Ивановна","field2":"5eb3bddf-9e10-11ed-ad53-00155d000912","field3":"ObolenskayaTI@mos.ru"}
,
{"field1":"Огай Игорь Александрович","field2":"bb1f6688-87c6-11f0-b114-00155d000912","field3":"ogayia@mos.ru"}
,
{"field1":"Олитто Алиса Андреевна","field2":"7dc9f951-d604-11ee-aee8-00155d000912","field3":"olittoaa@mos.ru"}
,
{"field1":"Ордина Юлия Игоревна","field2":"467963cc-d610-11ee-aee8-00155d000912","field3":"OrdinaYI@mos.ru"}
,
{"field1":"Орешкин Анатолий Александрович","field2":"df6a0332-93a9-11f0-b123-00155d000910","field3":"oreshkinaa5@mos.ru"}
,
{"field1":"Оруджев Руслан Тариелевич","field2":"a51b409c-b670-11ed-ad74-00155d000912","field3":"OrudzhevRT@mos.ru"}
,
{"field1":"Орудин Даниил Евгеньевич","field2":"d84f253d-1610-11f1-b1cb-00155d000912","field3":"OrudinDE@it.mos.ru"}
,
{"field1":"Осокина Екатерина Валерьевна","field2":"e04e7594-60d7-11f1-b22b-00155d000912","field3":"OsokinaEV2@it.mos.ru"}
,
{"field1":"Павлов Егор Андреевич","field2":"651b61c5-29ea-11ee-ae0b-00155d000912","field3":"pavlovea5@mos.ru"}
,
{"field1":"Павлова Елена Владимировна","field2":"a6f412da-0881-11eb-a9e7-00155d1a381f","field3":"PavlovaEV8@mos.ru"}
,
{"field1":"Павлушкина Мария Александровна","field2":"9b84090c-445c-11eb-aa34-00155d1a381f","field3":"PavlushkinaMA1@mos.ru"}
,
{"field1":"Пальмина Мария Александровна","field2":"8c62f6af-0bbb-11ec-ab33-00155d051a08","field3":"PalminaMA2@mos.ru"}
,
{"field1":"Панов Владимир Алексеевич","field2":"45dc113a-9787-11f0-b128-00155d000912","field3":"panoff.2000@yandex.ru"}
,
{"field1":"Пароходов Дмитрий Юрьевич","field2":"336db161-a202-11ed-ad58-00155d000910","field3":"ParokhodovDY@mos.ru"}
,
{"field1":"Парфенова Татьяна Борисовна","field2":"69057e6e-6e86-11ea-a9a4-00155d1a230c","field3":"ParfenovaTB@mos.ru"}
,
{"field1":"Пасенков Максим Владимирович","field2":"1cbe993d-5e6c-11ed-acfa-00155d000912","field3":"PasenkovMV@mos.ru"}
,
{"field1":"Пастушков Дмитрий Викторович","field2":"5327497f-d76f-11ed-ad9e-00155d000912","field3":"pastushkovdv@mos.ru"}
,
{"field1":"Пасугинова Мария Германовна","field2":"adc9c4af-160a-11f1-b1cb-00155d000912","field3":"pasuginovamg@mos.ru"}
,
{"field1":"Первушина Надежда Сергеевна","field2":"5a40701c-5551-11ef-af8c-00155d000912","field3":"PervushinaNS@mos.ru"}
,
{"field1":"Переход Артур Анатольевич","field2":"b7fcb954-283d-11f1-b1e3-00155d000912","field3":"PerekhodAA@mos.ru"}
,
{"field1":"Перова Ирина Владимировна","field2":"3d980d7a-e4f4-11ee-aefd-00155d000912","field3":"PerovaIV@mos.ru"}
,
{"field1":"Петрова Елена Вячеславовна","field2":"cfce59ee-28cd-11eb-aa10-00155d1a381f","field3":"PetrovaEV9@mos.ru"}
,
{"field1":"Петрякова Елена Николаевна","field2":"c74b9f6a-f4d0-11ef-b052-00155d000910","field3":"PetryakovaEN@mos.ru"}
,
{"field1":"Пирожков Илья Александрович","field2":"8d2b40b7-0583-11f1-b1b6-00155d000912","field3":"pirozhkovia@mos.ru"}
,
{"field1":"Питель Анна Алексеевна","field2":"95254cb3-f002-11ed-adbd-00155d000912","field3":"PitelAA@mos.ru"}
,
{"field1":"Платонова Мария Юрьевна","field2":"7c5e94dc-06be-11e9-a98f-00155d1a3433","field3":"KleymenovaMY@mos.ru"}
,
{"field1":"Плетнева Эльмира Ярулловна","field2":"d51922ed-7ce8-11ec-abc4-00155d051a08","field3":"PletnevaEY1@mos.ru"}
,
{"field1":"Плехов Михаил Владимирович","field2":"368efd5a-664e-11ed-ad05-00155d000910","field3":"PlekhovMV@mos.ru"}
,
{"field1":"Плотникова Алёна Сергеевна","field2":"39a4d764-aefe-11ee-aeb6-00155d000912","field3":"PlotnikovaAS1@mos.ru"}
,
{"field1":"Плохих Виктория Максимовна","field2":"019babf9-10fc-11ef-af35-00155d000912","field3":"PlokhikhVM@mos.ru"}
,
{"field1":"Погорелов Сергей Евгеньевич","field2":"954420c9-48c7-11ef-af7c-00155d000912","field3":"pogorelovse1@mos.ru"}
,
{"field1":"Подей Ольга Ивановна","field2":"ba3a959f-9c04-11ea-a9aa-00155d1a230c","field3":"PodejOI@mos.ru"}
,
{"field1":"Подлегаев-Головин Александр Дмитриевич","field2":"35cfcf07-fb01-11ee-af19-00155d000912","field3":"podlegaevgolovinad@mos.ru"}
,
{"field1":"Подосинова Анна Эмануиловна","field2":"cc072493-4e7d-11ea-a99f-00155d1a38ec","field3":"PodosinovaAE@mos.ru"}
,
{"field1":"Пожидаев Роман Олегович","field2":"fded8066-518a-11f0-b0ce-00155d000912","field3":"pozhidaevro@mos.ru"}
,
{"field1":"Поклонова Наталия Сергеевна","field2":"ec245c06-aec4-11ee-aeb6-00155d000912","field3":"PoklonovaNS@mos.ru"}
,
{"field1":"Поликарпова Карина Александровна","field2":"9e2bc0ad-4518-11eb-aa35-00155d1a381f","field3":"PolikarpovaKA@mos.ru"}
,
{"field1":"Полозова Анастасия Михайловна","field2":"0c10b326-3046-11ee-ae13-00155d000912","field3":"PolozovaAM@mos.ru"}
,
{"field1":"Полтавская Наталья Александровна","field2":"087227c0-4459-11eb-aa34-00155d1a381f","field3":"PoltavskayaNA1@mos.ru"}
,
{"field1":"Полякова Юлия Анатольевна","field2":"9b345a0e-d261-11eb-aaeb-00155d1a1df7","field3":"PolyakovaYA@mos.ru"}
,
{"field1":"Пономарёв Кирилл Сергеевич","field2":"b4dd3431-59c7-11f1-b222-00155d000912","field3":"ponomarevks@it.mos.ru"}
,
{"field1":"Попова Анастасия Александровна","field2":"f3646a00-2835-11f1-b1e3-00155d000912","field3":"PopovaAA3@mos.ru"}
,
{"field1":"Поспелов Семён Николаевич","field2":"dcc051f0-6602-11f0-b0e8-00155d000912","field3":"pospelovsn@mos.ru"}
,
{"field1":"Потапова Александра Сергеевна","field2":"93b15bd0-3bf1-11e9-a98f-00155d1a3433","field3":"PotapovaAS@mos.ru"}
,
{"field1":"Потошова Полина Романовна","field2":"2f682152-710e-11f0-b0f7-00155d000912","field3":"potoshovapr1@mos.ru"}
,
{"field1":"Преженцев Егор Матвеевич","field2":"e8af0642-d26b-11eb-aaeb-00155d1a1df7","field3":"PrezhentsevEM@mos.ru"}
,
{"field1":"Пудышев Никита Вадимович","field2":"3f2f9845-e4ac-11f0-b18c-00155d000910","field3":"PudyshevNV@mos.ru"}
,
{"field1":"Пылова Наталья Сергеевна","field2":"84badf29-13f9-11e9-a98f-00155d1a3433","field3":"PylovaNS@mos.ru"}
,
{"field1":"Пышный Игорь Олегович","field2":"1e291a5a-9fff-11ef-afec-00155d000910","field3":"pyshnyyio@mos.ru"}
,
{"field1":"Пышный Игорь Олегович","field2":"f118430d-d421-11f0-b177-00155d000912","field3":"pyshnyyio@mos.ru"}
,
{"field1":"Райдер Екатерина Сергеевна","field2":"de0e52ef-1978-11ee-adf4-00155d000910","field3":"krayder9@gmail.com"}
,
{"field1":"Ракус Мария Сергеевна","field2":"d37c2ad4-aa93-11f0-b140-00155d000912","field3":"rakusms@mos.ru"}
,
{"field1":"Ременникова Дарья Михайловна","field2":"0d377064-542f-11f1-b21b-00155d000912","field3":"remennikovadm@mos.ru"}
,
{"field1":"Репин Виктор Андреевич","field2":"482bbe96-f044-11f0-b19b-00155d000910","field3":"repinva2@mos.ru"}
,
{"field1":"Родкина Анастасия Валентиновна","field2":"7bac23ce-cfd4-11ee-aee0-00155d000910","field3":"RodkinaAV@mos.ru"}
,
{"field1":"Романов Николай Евгеньевич","field2":"9cb2a5cb-c716-11ee-aed5-00155d000910","field3":"romanovne@mos.ru"}
,
{"field1":"Ромашкина Надежда Александровна","field2":"f7373a4a-a0df-11eb-aaac-00155d1a381f","field3":"RomashkinaNA@mos.ru"}
,
{"field1":"Рубцова Анастасия Юрьевна","field2":"396728b6-7698-11ef-afb7-00155d000910","field3":"RubtsovaAY@mos.ru"}
,
{"field1":"Рудакова Дарья Константиновна","field2":"bc615e79-7e13-11ee-ae77-00155d000912","field3":"RudakovaDK@mos.ru"}
,
{"field1":"Рукавишникова Варвара Федоровна","field2":"5806ef7c-adc8-11ed-ad69-00155d000912","field3":"RukavishnikovaVF@mos.ru"}
,
{"field1":"Румянцева Анна Владимировна","field2":"b2f956df-5e7f-11f1-b228-00155d000912","field3":"RumyantsevaAV8@it.mos.ru"}
,
{"field1":"Русак Анна Андреевна","field2":"6d078731-65fd-11f0-b0e8-00155d000912","field3":"rusakaa@mos.ru"}
,
{"field1":"Рыжов Павел Борисович","field2":"1ca7bdc4-f063-11ec-ac6a-00155d000912","field3":"RyzhovPB@mos.ru"}
,
{"field1":"Рябова Наталья Леонидовна","field2":"75f87875-2d24-11f1-b1e9-00155d000910","field3":"RyabovaNL@mos.ru"}
,
{"field1":"Рябова Олеся Алексеевна","field2":"186688b9-2e6b-11f1-b1eb-00155d000910","field3":"ryabovaoa5@mos.ru"}
,
{"field1":"Саакян Жанна Хачатуровна","field2":"e2f3c8a0-4e97-11f1-b214-00155d000910","field3":"saakyanzk@mos.ru"}
,
{"field1":"Савва Екатерина Анатольевна","field2":"eca5cbbb-53d8-11ef-af8a-00155d000912","field3":"larryisrealforever74@gmail.com"}
,
{"field1":"Садыкова Заррина Сергеевна","field2":"1ac68c93-3984-11ed-accb-00155d000910","field3":"zayatut@bk.ru"}
,
{"field1":"Сазонов Игорь Александрович","field2":"2e4afa78-0380-11ee-add7-00155d000912","field3":"SazonovIA1@mos.ru"}
,
{"field1":"Самигуллина Эльвира Фирдауисовна","field2":"a1202dc4-2e7f-11ed-acbd-00155d000910","field3":"SamigullinaEF@mos.ru"}
,
{"field1":"Самойлова Полина Юрьевна","field2":"37cf2c4d-484d-11f1-b20c-00155d000912","field3":"samoylovapy@mos.ru"}
,
{"field1":"Самосудова Екатерина Евгеньевна","field2":"225e7ab8-1b05-11ee-adf8-00155d000912","field3":"samosudovaee@mos.ru"}
,
{"field1":"Самсонова Софья Павловна","field2":"e7fa36ba-5bd2-11f0-b0db-00155d000912","field3":"samsonovasp1@mos.ru"}
,
{"field1":"Сапицкая Кира Сергеевна","field2":"7ffe75ac-cef0-11ee-aedf-00155d000910","field3":"sapitskayaks@mos.ru"}
,
{"field1":"Сапрыкина Яна Андреевна","field2":"7b95158e-dfb1-11ee-aef6-00155d000910","field3":"yana.saprykina.01@inbox.ru"}
,
{"field1":"Саратина Валентина Александровна","field2":"9d39b990-6214-11f0-b0e3-00155d000912","field3":"saratinava@mos.ru"}
,
{"field1":"Сауляк Кирилл Андреевич","field2":"e038d315-e567-11ec-ac5c-00155d000912","field3":"SaulyakKA@mos.ru"}
,
{"field1":"Сафронов Павел Владимирович","field2":"80e1cb96-2ce2-11f1-b1e9-00155d000910","field3":"darthspv@gmail.com"}
,
{"field1":"Седнев Андрей Алексеевич","field2":"37e9ba80-82c2-11ee-ae7d-00155d000912","field3":"SednevAA1@mos.ru"}
,
{"field1":"Седова Александра Геннадьевна","field2":"767848fc-b3de-11ec-ac0a-00155d051a08","field3":"SedovaAG@mos.ru"}
,
{"field1":"Седова Александра Геннадьевна","field2":"5cd95fd7-cec4-11f0-b170-00155d000912","field3":"SedovaAG@mos.ru"}
,
{"field1":"Седова Татьяна Владимировна","field2":"740a6488-b080-11ef-b001-00155d000910","field3":"SedovaTV2@mos.ru"}
,
{"field1":"Селезнева Елена Анатольевна","field2":"62ea6a17-283f-11f1-b1e3-00155d000912","field3":"SeleznevaEA2@mos.ru"}
,
{"field1":"Селезнева Юлия Дмитриевна","field2":"abdd223f-7239-11ee-ae68-00155d000912","field3":"SeleznevaYD@mos.ru"}
,
{"field1":"Селиванникова Анастасия Андреевна","field2":"4e05b4b1-ffdd-11ef-b060-00155d000912","field3":"selivannikovaaa@mos.ru"}
,
{"field1":"Семенихина Анна Александровна","field2":"68361432-2845-11f1-b1e3-00155d000912","field3":"SemenikhinaAA1@mos.ru"}
,
{"field1":"Семенов Сергей Иванович","field2":"48f8e4de-d01a-11f0-b172-00155d000912","field3":"semenovsi4@mos.ru"}
,
{"field1":"Семёнова Анастасия Владиславовна","field2":"bb6449ba-0ed2-11f0-b073-00155d000910","field3":"SemenovaAV36@mos.ru"}
,
{"field1":"Семенова Дарья Александровна","field2":"780d7669-fd7a-11ef-b05d-00155d000912","field3":"SemenovaDA5@mos.ru"}
,
{"field1":"Семёнова Яна Алексеевна","field2":"31106b7b-235b-11f1-b1dd-00155d000912","field3":"semenovaya7@mos.ru"}
,
{"field1":"Сергеева Анна Владимировна","field2":"40c3a5ef-ea12-11f0-b193-00155d000910","field3":"SergeevaAV17@mos.ru"}
,
{"field1":"Сергеева Екатерина Евгеньевна","field2":"2eae260b-862d-11eb-aa8a-00155d1a381f","field3":"PolyakovaEE@mos.ru"}
,
{"field1":"Серегина Наталья Александровна","field2":"b6e65cad-e38f-11ef-b043-00155d000910","field3":"SereginaNA1@mos.ru"}
,
{"field1":"Серпкова Вероника Анатольевна","field2":"7ef91286-fbf0-11ea-a9d8-00155d1a381f","field3":"SerpkovaVA1@mos.ru"}
,
{"field1":"Сибагатуллина Лейсан Дамировна","field2":"5dd6f624-2174-11ef-af4a-00155d000910","field3":"sibagatullinald@mos.ru"}
,
{"field1":"Сидоров Алексей Юрьевич","field2":"8cb63d19-4a6b-11ef-af7e-00155d000912","field3":"sidorovay4@mos.ru"}
,
{"field1":"Сизова Анна Романовна","field2":"3412f8b3-1e88-11f0-b08c-00155d000910","field3":"SizovaAR@mos.ru"}
,
{"field1":"Сироткин Михаил Сергеевич","field2":"20785686-114c-11f1-b1c5-00155d000912","field3":"sirotkinms1@mos.ru"}
,
{"field1":"Скакун Екатерина Александровна","field2":"190f65b7-a683-11eb-aab3-00155d1a381f","field3":"ekaterina-alexandrovna1993@rambler.ru"}
,
{"field1":"Сметанкина Ольга Владимировна","field2":"05b975a3-4e0f-11ed-ace5-00155d000910","field3":"SmetankinaOV@mos.ru"}
,
{"field1":"Соболева Юлия Александровна","field2":"b41b9cde-1601-11f1-b1cb-00155d000912","field3":"sobolevaya3@mos.ru"}
,
{"field1":"Соколов Алексей Владимирович","field2":"1dee8c6e-c5f2-11f0-b163-00155d000910","field3":"sokolovav26@mos.ru"}
,
{"field1":"Соколов Максим Евгеньевич","field2":"27a80cc4-d2b9-11ed-ad98-00155d000910","field3":"SokolovME1@mos.ru"}
,
{"field1":"Соколов Роман Олегович","field2":"9e3f9a7b-dfbf-11ef-b03e-00155d000912","field3":"sokolovro@mos.ru"}
,
{"field1":"Солдатова Ирина Наилевна","field2":"c005fd21-44f2-11eb-aa35-00155d1a381f","field3":"SoldatovaIN@mos.ru"}
,
{"field1":"Солнцева Анастасия Сергеевна","field2":"f658ab9d-37ac-11f0-b0ad-00155d000910","field3":"SolntsevaAS@mos.ru"}
,
{"field1":"Соловьянов Алексей Александрович","field2":"43fd6d2e-b2d8-11ef-b004-00155d000910","field3":"SolovyanovAA@mos.ru"}
,
{"field1":"Солодова Виктория Романовна","field2":"3c39da64-5876-11ef-af90-00155d000912","field3":"SolodovaVR@mos.ru"}
,
{"field1":"Сорокина Анна Викторовна","field2":"6a65204d-d0b4-11ee-aee1-00155d000910","field3":"SorokinaAV9@mos.ru"}
,
{"field1":"Спецакова Виктория Евгеньевна","field2":"18facc28-2182-11ef-af4a-00155d000910","field3":"spetsakovave@mos.ru"}
,
{"field1":"Спивакова Дария Владимировна","field2":"3b522b37-1d8b-11ef-af45-00155d000912","field3":"SmirnovaDV4@mos.ru"}
,
{"field1":"Спиридонова Алёна Юрьевна","field2":"b9a721ee-70d0-11ef-afaf-00155d000912","field3":"SpiridonovaAY@mos.ru"}
,
{"field1":"Старовойтова Оксана Николаевна","field2":"b75d50c9-19c3-11f0-b086-00155d000912","field3":"StarovoytovaON@mos.ru"}
,
{"field1":"Степаненко Дмитрий Романович","field2":"0f659660-2535-11ee-ae05-00155d000912","field3":"StepanenkoDR@mos.ru"}
,
{"field1":"Степанова Анна Алексеевна","field2":"27180a6b-03c5-11f0-b065-00155d000912","field3":"StepanovaAA6@mos.ru"}
,
{"field1":"Степанько Анастасия Вячеславовна","field2":"fea04f60-2843-11f1-b1e3-00155d000912","field3":"StepankoAV@mos.ru"}
,
{"field1":"Страковский Илья Дмитриевич","field2":"4d8b7384-0374-11ee-add7-00155d000912","field3":"StrakovskiyID@mos.ru"}
,
{"field1":"Стрелкова Галина Юрьевна","field2":"7b4313b4-5f30-11ec-ab9d-00155d051a08","field3":"g_strelkova@mail.ru"}
,
{"field1":"Строгонова Алина Александровна","field2":"97e5f352-6c46-11f0-b0f1-00155d000910","field3":"fedorovaaa2@mos.ru"}
,
{"field1":"Ступина Карина Александровна","field2":"ee30f569-5ec1-11ef-af98-00155d000912","field3":"StupinaKA@mos.ru"}
,
{"field1":"Суздалева Екатерина Васильевна","field2":"e7490d98-5964-11eb-aa51-00155d1a381f","field3":"SuzdalevaEV@mos.ru"}
,
{"field1":"Суров Даниил Сергеевич","field2":"f9536d7b-8389-11ee-ae7e-00155d000912","field3":"SurovDS@mos.ru"}
,
{"field1":"Сухорученко Алла Васильевна","field2":"851cf7e6-10f8-11ef-af35-00155d000912","field3":"SukhoruchenkoAV@mos.ru"}
,
{"field1":"Тамаева Радимхан Албуриевна","field2":"b4e96a79-678e-11f0-b0ea-00155d000912","field3":"tamaevara@mos.ru"}
,
{"field1":"Тарасова Дарья Михайловна","field2":"2a3337ea-363b-11ec-ab69-00155d051a08","field3":"tarasovadm@mos.ru"}
,
{"field1":"Тарасова Елизавета Александровна","field2":"04a2c285-0ae2-11f0-b06e-00155d000912","field3":"SolodukhinaEA@mos.ru"}
,
{"field1":"Тарасова Юлия Батаровна","field2":"4a9d637a-f1e8-11f0-b19d-00155d000910","field3":"juotchepkova@mail.ru"}
,
{"field1":"Таршилова Дарья Денисовна","field2":"7a0eded1-eccf-11ee-af07-00155d000910","field3":"TarshilovaDD@mos.ru"}
,
{"field1":"Текунова Наталия Юрьевна","field2":"f61748aa-0ae2-11f0-b06e-00155d000912","field3":"tekunovany@mos.ru"}
,
{"field1":"Тимакова Маргарита Сергеевна","field2":"91eba1a2-9bba-11ed-ad50-00155d000912","field3":"GegechkoriMS@mos.ru"}
,
{"field1":"Тимофеев Алексей Романович","field2":"8bf6ed13-9773-11ef-afe1-00155d000912","field3":"alian.tim.job24@gmail.com"}
,
{"field1":"Титкова Елена Андреевна","field2":"c2959716-6f40-11ef-afad-00155d000912","field3":"TitkovaEA2@mos.ru"}
,
{"field1":"Титова Елена Николаевна","field2":"ac5d5ad3-c58f-11ee-aed3-00155d000912","field3":"TitovaEN5@mos.ru"}
,
{"field1":"Титова Елизавета Сергеевна","field2":"4e76da36-8e14-11f0-b11c-00155d000910","field3":"titovaes1@mos.ru"}
,
{"field1":"Тихонов Андрей Викторович","field2":"4160379d-639c-11f0-b0e5-00155d000912","field3":"tikhonovav7@mos.ru"}
,
{"field1":"Тихонов Тимофей Лукьянович","field2":"b4af3cf2-e791-11ef-b046-00155d000910","field3":"TikhonovTL@mos.ru"}
,
{"field1":"Тишкова Елизавета Валерьевна","field2":"c5558a81-4004-11ee-ae28-00155d000912","field3":"TishkovaEV2@mos.ru"}
,
{"field1":"Ткачев Егор Дмитриевич","field2":"62cceee3-2848-11f1-b1e3-00155d000912","field3":"tkacheved@mos.ru"}
,
{"field1":"Товкач Максим Николаевич","field2":"31d29a21-69e5-11eb-aa66-00155d1a381f","field3":"TovkachMN@mos.ru"}
,
{"field1":"Токовая Анна Владимировна","field2":"bc6dbda5-9d70-11ee-aea0-00155d000910","field3":"anettok1324@gmail.com"}
,
{"field1":"Толканов Константин Александрович","field2":"0ca348e2-e12d-11ea-a9ca-00155d1a381f","field3":"TolkanovKA@mos.ru"}
,
{"field1":"Томилова Александра Анатольевна","field2":"979da903-ca3c-11ee-aed9-00155d000910","field3":"TomilovaAA1@mos.ru"}
,
{"field1":"Трегулов Ильдар Фяритович","field2":"dbd91dce-9690-11ef-afe0-00155d000910","field3":"TregulovIF@mos.ru"}
,
{"field1":"Тришина Людмила Артуровна","field2":"de9ffcaf-0878-11ef-af2a-00155d000912","field3":"TrishinaLA@mos.ru"}
,
{"field1":"Трофимова Екатерина Валерьевна","field2":"2b241366-97f8-11ee-ae99-00155d000912","field3":"trofimovaev@mos.ru"}
,
{"field1":"Труфанов Сергей Андреевич","field2":"62c29c5f-52f2-11ef-af89-00155d000910","field3":"TrufanovSA@mos.ru"}
,
{"field1":"Тычко Лариса Владимировна","field2":"8ac31542-c02b-11ea-a9c0-00155d1a381f","field3":"TychkoLV@mos.ru"}
,
{"field1":"Тюрина Анна Александровна","field2":"f3cb3aa3-3ff3-11ee-ae28-00155d000912","field3":"TyurinaAA6@mos.ru"}
,
{"field1":"Удалов Кирилл Александрович","field2":"ef393165-283f-11f1-b1e3-00155d000912","field3":"UdalovKA@mos.ru"}
,
{"field1":"Удачина Юлия Ивановна","field2":"57107999-c3d4-11ed-ad85-00155d000912","field3":"udachinayi@mos.ru"}
,
{"field1":"Уколова Елена Николаевна","field2":"84badf17-13f9-11e9-a98f-00155d1a3433","field3":"UkolovaEN@mos.ru"}
,
{"field1":"Уралова Ирина Сергеевна","field2":"8263f1cc-03df-11ec-ab29-00155d051a08","field3":"RogovaIS@mos.ru"}
,
{"field1":"Урсув Мария Анатольевна","field2":"35a8f560-60d5-11f1-b22b-00155d000912","field3":""}
,
{"field1":"Устинов Станислав Николаевич","field2":"eb015f60-5c8f-11f0-b0dc-00155d000912","field3":"ustinovsn1@mos.ru"}
,
{"field1":"Уткин Иван Вячеславович","field2":"1ecaaf18-2064-11ec-ab4d-00155d051a08","field3":"UtkinIV@mos.ru"}
,
{"field1":"Уткина Надежда Евгеньевна","field2":"d5997c86-4443-11eb-aa34-00155d1a381f","field3":"UtkinaNE@mos.ru"}
,
{"field1":"Ухина Наталья Вениаминовна","field2":"24ef102b-607b-11f0-b0e1-00155d000912","field3":"ukhinanv@mos.ru"}
,
{"field1":"Федина Ольга Николаевна","field2":"3a844461-a200-11ed-ad58-00155d000910","field3":"FedinaON@mos.ru"}
,
{"field1":"Федоров Филипп Игоревич","field2":"178e788a-58ed-11ed-acf3-00155d000912","field3":"FedorovFI2@mos.ru"}
,
{"field1":"Федулов Вадим Владимирович","field2":"dfec3a2f-2979-11f0-b09a-00155d000910","field3":"FedulovVV1@mos.ru"}
,
{"field1":"Федулова Мария Вадимовна","field2":"4dc742b4-7f40-11ec-abc7-00155d051a08","field3":"FedulovaMV@mos.ru"}
,
{"field1":"Федькина Ирина Валерьевна","field2":"0ff389f3-6497-11f1-b230-00155d000912","field3":"fedkinaiv@mos.ru"}
,
{"field1":"Филатов Андрей Юрьевич","field2":"43687673-b1b7-11ed-ad6e-00155d000912","field3":"FilatovAY4@mos.ru"}
,
{"field1":"Филенко Иван Владимирович","field2":"8da4d5a7-42c7-11f1-b205-00155d000912","field3":"filenkoiv@mos.ru"}
,
{"field1":"Филипкин Владимир Владимирович","field2":"5951e685-21a8-11f0-b090-00155d000912","field3":"FilipkinVV1@mos.ru"}
,
{"field1":"Филиппов Алексей Игоревич","field2":"7c69b30e-f11a-11f0-b19c-00155d000912","field3":"filippovai1@mos.ru"}
,
{"field1":"Фисунова Ольга Дмитриевна","field2":"91a1bf67-b933-11ef-b00c-00155d000912","field3":"FisunovaOD@mos.ru"}
,
{"field1":"Фогель Виктория Сергеевна","field2":"cda73f20-3a98-11ef-af6a-00155d000912","field3":"lukinavs1@mos.ru"}
,
{"field1":"Фон Анна Александровна","field2":"ff748d83-4407-11ef-af76-00155d000912","field3":"fonaa@mos.ru"}
,
{"field1":"Фролова Дарья Владимировна","field2":"3cdf20e7-5073-11ee-ae3d-00155d000912","field3":"OzhoginaDV@mos.ru"}
,
{"field1":"Хабибуллина Алиса Константиновна","field2":"fffdf58f-b498-11f0-b14d-00155d000910","field3":"KhabibullinaAK@mos.ru"}
,
{"field1":"Хайртдинов Тимур Ильгизович","field2":"3d3f480f-7358-11f0-b0fa-00155d000912","field3":"radyrabochaya@mail.ru"}
,
{"field1":"Хертек Долаана Александровна","field2":"7c4588d6-df7e-11ee-aef6-00155d000910","field3":"KhertekDA@mos.ru"}
,
{"field1":"Хорошилова Екатерина Леонидовна","field2":"cb10f96d-58d7-11f1-b221-00155d000912","field3":"KhoroshilovaEL@it.mos.ru"}
,
{"field1":"Хрыпченко Любовь Сергеевна","field2":"39f356dc-8ac9-11ef-afd1-00155d000912","field3":"KhrypchenkoLS@mos.ru"}
,
{"field1":"Цапковская Людмила Витальевна","field2":"94c10f5c-ff36-11eb-ab23-00155d051a08","field3":"TsapkovskayaLV1@mos.ru"}
,
{"field1":"Цапковский Иван Валерьевич","field2":"73c35652-3d4a-11f1-b1fe-00155d000912","field3":"tsapkovskijiv@mos.ru"}
,
{"field1":"Цвеловская Анастасия Константиновна","field2":"b05b8c78-87fb-11ec-abd2-00155d051a08","field3":"tsvelovskayaak@mos.ru"}
,
{"field1":"Цыпленков Данил Олегович","field2":"35660c88-8a3f-11ec-abd5-00155d051a08","field3":"TsyplenkovDO@mos.ru"}
,
{"field1":"Чагдурова Лариса Валерьевна","field2":"4b5684c4-3316-11eb-aa1d-00155d1a381f","field3":"ChagdurovaLV@mos.ru"}
,
{"field1":"Чадин Руслан Михайлович","field2":"5ca3e68b-4530-11eb-aa35-00155d1a381f","field3":"ChadinRM@mos.ru"}
,
{"field1":"Чайка Диана Александровна","field2":"6f093c52-be02-11f0-b159-00155d000912","field3":"chaykada@mos.ru"}
,
{"field1":"Черва Александра Александровна","field2":"8d00bafc-3774-11ef-af66-00155d000910","field3":"ChervaAA@mos.ru"}
,
{"field1":"Черкас Анжелика Анатольевна","field2":"d381a7a0-5915-11f1-b221-00155d000912","field3":"CherkasAA@it.mos.ru"}
,
{"field1":"Чернов Александр Викторович","field2":"32935972-8ef5-11ec-abdb-00155d051a08","field3":"ChernovAV9@mos.ru"}
,
{"field1":"Чернышева Анастасия Дмитриевна","field2":"14c715f4-1352-11ef-af38-00155d000910","field3":"ChernyshevaAD@mos.ru"}
,
{"field1":"Чефонова Яна Игоревна","field2":"d1b2fb48-d0a2-11ee-aee1-00155d000910","field3":"ChefonovaYI@mos.ru"}
,
{"field1":"Чубченко Марина Михайловна","field2":"7bcff80d-49fb-11ed-ace0-00155d000910","field3":"ChubchenkoMM1@mos.ru"}
,
{"field1":"Шатский Максим Сергеевич","field2":"326e087e-ee93-11ef-b04a-00155d000910","field3":"shatskiyms1@mos.ru"}
,
{"field1":"Шаховская Мария Сергеевна","field2":"3373e15b-7f44-11f0-b109-00155d000912","field3":"shakhovskayams@mos.ru"}
,
{"field1":"Шахумов Рамазан Ширинович","field2":"0d5e4a94-4129-11ec-ab77-00155d051a08","field3":"ShokhumovRS@mos.ru"}
,
{"field1":"Шванская Ирина Никитовна","field2":"a94fd772-3a7b-11ee-ae20-00155d000910","field3":"irensky13@gmail.com"}
,
{"field1":"Швырёва Татьяна Андреевна","field2":"ac5ba39a-42cc-11f0-b0bb-00155d000912","field3":"shvyrevata@mos.ru"}
,
{"field1":"Шевкунов Дмитрий Игоревич","field2":"7cb72567-3670-11ec-ab69-00155d051a08","field3":"ShevkunovDI@mos.ru"}
,
{"field1":"Шевченко Анна Игоревна","field2":"f61e580e-dc7a-11ef-b03a-00155d000912","field3":"shevchenkoai2@mos.ru"}
,
{"field1":"Шевченко Евгения Сергеевна","field2":"6799679c-dc02-11ec-ac4e-00155d000912","field3":"ShevchenkoES1@mos.ru"}
,
{"field1":"Шек Дарья Станиславовна","field2":"858eb849-6309-11f1-b22e-00155d000912","field3":"shekds@mos.ru"}
,
{"field1":"Шершнева Ольга Владимировна","field2":"4c004300-5b23-11f1-b224-00155d000912","field3":"shershnevaov3@mos.ru"}
,
{"field1":"Шигаев Ринат Ханяфеевич","field2":"8ff4e4ca-22ea-11e9-a98f-00155d1a3433","field3":"ShigaevRK@mos.ru"}
,
{"field1":"Ширшова Варвара Александровна","field2":"d3dba922-3182-11ec-ab63-00155d051a08","field3":"ShirshovaVA@mos.ru"}
,
{"field1":"Ширяева Анна Александровна","field2":"a6aee82d-be81-11ee-aeca-00155d000912","field3":"ShiryaevaAA4@mos.ru"}
,
{"field1":"Шитова Виктория Александровна","field2":"92d8696d-1ef0-11ee-adfd-00155d000912","field3":"ShitovaVA1@mos.ru"}
,
{"field1":"Шитова Ксения Игоревна","field2":"8a9492cc-5709-11eb-aa4d-00155d1a381f","field3":"ShitovaKI1@mos.ru"}
,
{"field1":"Шкелев Антон Алексеевич","field2":"23102f09-cefd-11ee-aedf-00155d000910","field3":"shkelevaa@mos.ru"}
,
{"field1":"Шмакова Нина Сергеевна","field2":"fef4a26f-2837-11f1-b1e3-00155d000912","field3":"ShmakovaNS1@mos.ru"}
,
{"field1":"Шорникова Екатерина Сергеевна","field2":"f8d4f9b5-4c0b-11ea-a99f-00155d1a38ec","field3":"ShornikovaES@mos.ru"}
,
{"field1":"Эрболатова Амина Уллубиевна","field2":"25c1d10d-b384-11ee-aebc-00155d000912","field3":"ErbolatovaAU@mos.ru"}
,
{"field1":"Юсипов Руслан Тагерович","field2":"c97e820a-424f-11ee-ae2b-00155d000910","field3":"YusipovRT@mos.ru"}
,
{"field1":"Юсупов Егор Евгеньевич","field2":"213045e0-3f5a-11ef-af70-00155d000910","field3":"YusupovEE@mos.ru"}
,
{"field1":"Юшко Кирилл Дмитриевич","field2":"4c5c7abb-8ed8-11f0-b11d-00155d000910","field3":"yushkokd@mos.ru"}
,
{"field1":"Яговкина Анастасия Игоревна","field2":"65686247-f282-11ef-b04f-00155d000910","field3":"YagovkinaAI@mos.ru"}
,
{"field1":"Яковлева Мария Игоревна","field2":"0e1e1976-2831-11f1-b1e3-00155d000912","field3":"YakovlevaMI1@mos.ru"}
,
{"field1":"Яковлева Татьяна Геннадьевна","field2":"97d07e02-e500-11ee-aefd-00155d000912","field3":"YakovlevaTG5@mos.ru"}
,
{"field1":"Янгурская Екатерина Андреевна","field2":"a6ed3442-21cf-11f1-b1db-00155d000910","field3":"yangurskayaea@mos.ru"}
,
{"field1":"Яндрова Мария Анатольевна","field2":"d3596a91-bfe8-11e9-a994-00155d1a3432","field3":"YandrovaMA@mos.ru"}
,
{"field1":"Яновский Никита Валерьевич","field2":"6a9c0799-71c7-11f0-b0f8-00155d000910","field3":"yanovskiynv@mos.ru"}
,
{"field1":"Ящук Евгений Андреевич","field2":"3d347425-0b09-11f1-b1bd-00155d000912","field3":"yaschukea@mos.ru"}

]
';

$jsonFileMasurovNew = json_decode($jsonFileMasurov, true);
foreach ($jsonFileMasurovNew as $item){
    $jsonFileMasurovNew1[$item['field3']]=$item['field2'];
}


$jsonFileCorp='
[
{"Логин":"TokovayaAV","Активность":"Да","Дата изменения":"","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"TokovayaAV@mos.ru","Дата регистрации":"11.08.2026 05:46:05","Последняя авторизация":"","ID":"1221","Подразделения":""}
,
{"Логин":"StupinaTA","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"Татьяна","Фамилия":"Ступина","Внешний код":"","E-Mail":"StupinaTA@mos.ru","Дата регистрации":"30.07.2026 17:23:17","Последняя авторизация":"11.08.2026 07:54:23","ID":"1219","Подразделения":"Группа гастропроектов"}
,
{"Логин":"ShiryaevaPS","Активность":"Да","Дата изменения":"04.08.2026 05:32:08","Имя":"Полина","Фамилия":"Ширяева","Внешний код":"","E-Mail":"ShiryaevaPS@mos.ru","Дата регистрации":"30.07.2026 17:23:16","Последняя авторизация":"10.08.2026 17:46:20","ID":"1218","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"AleksandrovaKP","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Ксения","Фамилия":"Александрова","Внешний код":"","E-Mail":"AleksandrovaKP@it.mos.ru","Дата регистрации":"28.07.2026 17:19:05","Последняя авторизация":"","ID":"1216","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"GzhelyakIA","Активность":"Да","Дата изменения":"07.08.2026 17:39:05","Имя":"Иван","Фамилия":"Гжеляк","Внешний код":"f1ed377c-8988-11f1-b25f-00155d000910","E-Mail":"GzhelyakIA@mos.ru","Дата регистрации":"27.07.2026 17:17:15","Последняя авторизация":"07.08.2026 09:04:43","ID":"1215","Подразделения":"Управление по развитию гостиничной инфраструктуры"}
,
{"Логин":"KobtsevAN","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Алексей","Фамилия":"Кобцев","Внешний код":"8e11ff94-8659-11f1-b25b-00155d000910","E-Mail":"KobtsevAN1@mos.ru","Дата регистрации":"23.07.2026 05:08:07","Последняя авторизация":"05.08.2026 10:32:26","ID":"1212","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"SavinYN","Активность":"Да","Дата изменения":"06.08.2026 05:36:24","Имя":"Юрий","Фамилия":"Савин","Внешний код":"","E-Mail":"SavinYN@mos.ru","Дата регистрации":"15.07.2026 16:53:06","Последняя авторизация":"07.08.2026 16:51:31","ID":"1207","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"BakhteevaSA","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"Софья","Фамилия":"Бахтеева","Внешний код":"","E-Mail":"BakhteevaSA@mos.ru","Дата регистрации":"15.07.2026 16:53:04","Последняя авторизация":"06.08.2026 11:57:16","ID":"1206","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"TitovaEN","Активность":"Да","Дата изменения":"","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"TitovaEN5@mos.ru","Дата регистрации":"15.07.2026 04:52:09","Последняя авторизация":"","ID":"1205","Подразделения":""}
,
{"Логин":"ArzhevitinaAV","Активность":"Да","Дата изменения":"07.08.2026 05:38:04","Имя":"Анастасия","Фамилия":"Аржевитина","Внешний код":"","E-Mail":"ArzhevitinaAV@mos.ru","Дата регистрации":"14.07.2026 16:51:10","Последняя авторизация":"06.08.2026 11:54:31","ID":"1204","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"MagkeevaMV","Активность":"Да","Дата изменения":"07.08.2026 05:38:04","Имя":"Мадина","Фамилия":"Магкеева","Внешний код":"ec74db24-7e82-11f1-b251-00155d000910","E-Mail":"MagkeevaMV@mos.ru","Дата регистрации":"13.07.2026 16:49:22","Последняя авторизация":"","ID":"1202","Подразделения":"Управление нормативно-правового регулирования и законодательных инициатив"}
,
{"Логин":"MedvedevaAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:14","Имя":"Анастасия","Фамилия":"Медведева","Внешний код":"","E-Mail":"MedvedevaAA13@mos.ru","Дата регистрации":"13.07.2026 15:45:55","Последняя авторизация":"10.08.2026 08:58:24","ID":"1201","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"PetrovaAV","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"Анастасия","Фамилия":"Петрова","Внешний код":"39225104-7aac-11f1-b24c-00155d000912","E-Mail":"PetrovaAV1@mos.ru","Дата регистрации":"10.07.2026 16:44:18","Последняя авторизация":"03.08.2026 10:19:03","ID":"1199","Подразделения":"Управление развития коммерческих партнерств"}
,
{"Логин":"SuhovAV","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Антон","Фамилия":"Сухов","Внешний код":"","E-Mail":"sukhovav5@it.mos.ru","Дата регистрации":"10.07.2026 16:44:18","Последняя авторизация":"","ID":"1200","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"ZhukovaTK","Активность":"Да","Дата изменения":"01.08.2026 05:26:04","Имя":"Татьяна","Фамилия":"Жукова","Внешний код":"","E-Mail":"ZhukovaTK@mos.ru","Дата регистрации":"10.07.2026 16:44:08","Последняя авторизация":"10.08.2026 17:44:34","ID":"1197","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"DrobaOL","Активность":"Да","Дата изменения":"06.08.2026 05:36:24","Имя":"Ольга","Фамилия":"Дроба","Внешний код":"","E-Mail":"drobaol@it.mos.ru","Дата регистрации":"08.07.2026 16:40:10","Последняя авторизация":"","ID":"1193","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"KleshnyaIA","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"KleshnyaIA@mos.ru","Дата регистрации":"06.07.2026 16:35:59","Последняя авторизация":"10.08.2026 17:21:20","ID":"1191","Подразделения":""}
,
{"Логин":"BasharovaII","Активность":"Да","Дата изменения":"07.08.2026 17:39:05","Имя":"Ирина","Фамилия":"Башарова","Внешний код":"9921bdbc-7905-11f1-b24a-00155d000910","E-Mail":"BasharovaII1@mos.ru","Дата регистрации":"03.07.2026 16:29:12","Последняя авторизация":"11.08.2026 08:52:38","ID":"1189","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"CherkasAA","Активность":"Да","Дата изменения":"04.08.2026 17:33:06","Имя":"","Фамилия":"","Внешний код":"d381a7a0-5915-11f1-b221-00155d000912","E-Mail":"CherkasAA@it.mos.ru","Дата регистрации":"03.07.2026 16:29:11","Последняя авторизация":"","ID":"1188","Подразделения":""}
,
{"Логин":"AntonetsAA","Активность":"Да","Дата изменения":"07.08.2026 17:39:05","Имя":"Александра","Фамилия":"Антонец","Внешний код":"3ba39e0b-75e4-11f1-b246-00155d000912","E-Mail":"Antonetsaa@it.mos.ru","Дата регистрации":"02.07.2026 16:27:06","Последняя авторизация":"","ID":"1186","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KalachevaMA","Активность":"Да","Дата изменения":"14.07.2026 16:51:10","Имя":"Мария","Фамилия":"Калачева","Внешний код":"7f56d685-7480-11f1-b244-00155d000912","E-Mail":"KalachevaMA@mos.ru","Дата регистрации":"01.07.2026 16:25:27","Последняя авторизация":"","ID":"1185","Подразделения":"Заместитель генерального директора по развитию и реализации специальных проектов"}
,
{"Логин":"AverkinaSM","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"Светлана","Фамилия":"Аверкина","Внешний код":"ad138470-751f-11f1-b245-00155d000912","E-Mail":"AverkinaSM@mos.ru","Дата регистрации":"30.06.2026 16:23:07","Последняя авторизация":"10.08.2026 13:07:07","ID":"1184","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"TarasovaEA","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"TarasovaEA27@mos.ru","Дата регистрации":"26.06.2026 16:16:04","Последняя авторизация":"10.08.2026 10:26:16","ID":"1182","Подразделения":""}
,
{"Логин":"OrlovaDA","Активность":"Да","Дата изменения":"10.08.2026 17:45:15","Имя":"Диана","Фамилия":"Орлова","Внешний код":"c28b23f7-6f98-11f1-b23e-00155d000910","E-Mail":"OrlovaDA8@it.mos.ru","Дата регистрации":"24.06.2026 16:10:06","Последняя авторизация":"","ID":"1180","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"KovalevaIA","Активность":"Да","Дата изменения":"06.08.2026 05:36:23","Имя":"Ирина","Фамилия":"Ковалева","Внешний код":"141ef862-6fad-11f1-b23e-00155d000910","E-Mail":"KovalevaIA9@it.mos.ru","Дата регистрации":"24.06.2026 16:10:04","Последняя авторизация":"","ID":"1179","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"user_1178","Активность":"Да","Дата изменения":"31.07.2026 12:29:11","Имя":"Елизавета","Фамилия":"Лукина","Внешний код":"452e2956-6e06-11f1-b23c-00155d000910","E-Mail":"lukinaed@mos.ru","Дата регистрации":"23.06.2026 04:02:28","Последняя авторизация":"06.08.2026 14:18:23","ID":"1178","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"ChechnevaAV","Активность":"Да","Дата изменения":"06.08.2026 17:37:08","Имя":"Анастасия","Фамилия":"Чечнева","Внешний код":"ac125680-6e17-11f1-b23c-00155d000910","E-Mail":"ChechnevaAV@it.mos.ru","Дата регистрации":"22.06.2026 16:05:09","Последняя авторизация":"","ID":"1177","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"SautievaLI","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Лейла","Фамилия":"Саутиева","Внешний код":"93635cdf-6e0f-11f1-b23c-00155d000910","E-Mail":"SautievaLI@mos.ru","Дата регистрации":"22.06.2026 13:32:18","Последняя авторизация":"30.07.2026 09:48:01","ID":"1176","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"BogatyrevIV","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Игорь","Фамилия":"Богатырев","Внешний код":"3c3fb824-6bdf-11f1-b239-00155d000912","E-Mail":"BogatyrevIV2@mos.ru","Дата регистрации":"19.06.2026 16:00:11","Последняя авторизация":"04.08.2026 12:27:15","ID":"1175","Подразделения":"Управление исследовательских проектов"}
,
{"Логин":"BelyaevaOA","Активность":"Да","Дата изменения":"07.08.2026 17:39:05","Имя":"Ольга","Фамилия":"Беляева","Внешний код":"37b8c4d5-6954-11f1-b236-00155d000910","E-Mail":"BelyaevaOA2@it.mos.ru","Дата регистрации":"16.06.2026 15:55:08","Последняя авторизация":"07.08.2026 11:17:38","ID":"1174","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"TorgonskayaRN","Активность":"Да","Дата изменения":"07.08.2026 17:39:05","Имя":"Регина","Фамилия":"Торгонская","Внешний код":"86e8dc6a-6954-11f1-b236-00155d000910","E-Mail":"TorgonskayaRN@mos.ru","Дата регистрации":"16.06.2026 03:54:02","Последняя авторизация":"31.07.2026 10:51:31","ID":"1173","Подразделения":"Управление по развитию коммерческих продуктов"}
,
{"Логин":"UrsuvMA","Активность":"Да","Дата изменения":"06.08.2026 05:36:23","Имя":"Мария","Фамилия":"Урсув","Внешний код":"","E-Mail":"UrsuvMA@it.mos.ru","Дата регистрации":"11.06.2026 15:45:16","Последняя авторизация":"","ID":"1172","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"KopaKD","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Кристина","Фамилия":"Копа","Внешний код":"66457c6c-60db-11f1-b22b-00155d000912","E-Mail":"KopaKD@it.mos.ru","Дата регистрации":"11.06.2026 15:45:15","Последняя авторизация":"","ID":"1171","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"FedkinaIV","Активность":"Да","Дата изменения":"23.07.2026 17:09:10","Имя":"Ирина","Фамилия":"Федькина","Внешний код":"0ff389f3-6497-11f1-b230-00155d000912","E-Mail":"FedkinaIV@mos.ru","Дата регистрации":"10.06.2026 03:42:16","Последняя авторизация":"23.07.2026 14:36:41","ID":"1168","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"OsokinaEV","Активность":"Да","Дата изменения":"31.07.2026 17:25:05","Имя":"Екатерина","Фамилия":"Осокина","Внешний код":"e04e7594-60d7-11f1-b22b-00155d000912","E-Mail":"OsokinaEV2@it.mos.ru","Дата регистрации":"10.06.2026 03:42:16","Последняя авторизация":"","ID":"1169","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"ShekDS","Активность":"Да","Дата изменения":"06.08.2026 17:37:08","Имя":"Дарья","Фамилия":"Шек","Внешний код":"858eb849-6309-11f1-b22e-00155d000912","E-Mail":"ShekDS@mos.ru","Дата регистрации":"08.06.2026 15:38:26","Последняя авторизация":"06.08.2026 11:03:31","ID":"1165","Подразделения":"Управление международного продвижения"}
,
{"Логин":"user_1161","Активность":"Да","Дата изменения":"10.07.2026 04:02:50","Имя":"Дарья","Фамилия":"Ременникова","Внешний код":"0d377064-542f-11f1-b21b-00155d000912","E-Mail":"remennikovadm@mos.ru","Дата регистрации":"05.06.2026 04:02:56","Последняя авторизация":"04.08.2026 10:03:15","ID":"1161","Подразделения":"Управление дизайна"}
,
{"Логин":"NikitinaKV","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Ксения","Фамилия":"Никитина","Внешний код":"4c1f6803-5e93-11f1-b228-00155d000912","E-Mail":"NikitinaKV4@it.mos.ru","Дата регистрации":"03.06.2026 15:28:09","Последняя авторизация":"","ID":"1159","Подразделения":""}
,
{"Логин":"VinokurovaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Анна","Фамилия":"Винокурова","Внешний код":"bd49625c-5db6-11f1-b227-00155d000912","E-Mail":"VinokurovaAA4@it.mos.ru","Дата регистрации":"03.06.2026 15:28:09","Последняя авторизация":"31.07.2026 10:31:08","ID":"1160","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"RumyantsevaAV","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Анна","Фамилия":"Румянцева","Внешний код":"b2f956df-5e7f-11f1-b228-00155d000912","E-Mail":"RumyantsevaAV8@it.mos.ru","Дата регистрации":"03.06.2026 15:28:07","Последняя авторизация":"","ID":"1158","Подразделения":""}
,
{"Логин":"AzarovaLV","Активность":"Да","Дата изменения":"05.08.2026 17:35:05","Имя":"Лариса","Фамилия":"Азарова","Внешний код":"db164982-5e53-11f1-b228-00155d000912","E-Mail":"AzarovaLV@mos.ru","Дата регистрации":"02.06.2026 15:26:06","Последняя авторизация":"05.08.2026 11:50:22","ID":"1157","Подразделения":"Управление международного продвижения"}
,
{"Логин":"LitvinovaMV","Активность":"Да","Дата изменения":"03.08.2026 05:30:06","Имя":"Мария","Фамилия":"Литвинова","Внешний код":"c9c5b757-5e50-11f1-b228-00155d000912","E-Mail":"LitvinovaMV1@mos.ru","Дата регистрации":"01.06.2026 15:24:08","Последняя авторизация":"11.08.2026 06:28:52","ID":"1156","Подразделения":"Управление развития коммерческих партнерств"}
,
{"Логин":"PonomarevKS","Активность":"Да","Дата изменения":"01.08.2026 05:26:05","Имя":"Кирилл","Фамилия":"Пономарёв","Внешний код":"b4dd3431-59c7-11f1-b222-00155d000912","E-Mail":"PonomarevKS@it.mos.ru","Дата регистрации":"29.05.2026 15:19:31","Последняя авторизация":"23.07.2026 13:40:02","ID":"1155","Подразделения":""}
,
{"Логин":"MiftakhovaAI","Активность":"Да","Дата изменения":"03.08.2026 17:31:14","Имя":"","Фамилия":"","Внешний код":"f9b0aeb3-599d-11f1-b222-00155d000912","E-Mail":"MiftakhovaAI@it.mos.ru","Дата регистрации":"29.05.2026 15:19:30","Последняя авторизация":"23.07.2026 15:06:14","ID":"1154","Подразделения":""}
,
{"Логин":"KhoroshilovaEL","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Екатерина","Фамилия":"Хорошилова","Внешний код":"cb10f96d-58d7-11f1-b221-00155d000912","E-Mail":"KhoroshilovaEL@it.mos.ru","Дата регистрации":"28.05.2026 15:17:14","Последняя авторизация":"07.08.2026 11:52:25","ID":"1150","Подразделения":""}
,
{"Логин":"ShershnevaOV","Активность":"Да","Дата изменения":"10.08.2026 17:45:14","Имя":"Ольга","Фамилия":"Шершнева","Внешний код":"4c004300-5b23-11f1-b224-00155d000912","E-Mail":"ShershnevaOV3@mos.ru","Дата регистрации":"28.05.2026 15:17:14","Последняя авторизация":"10.08.2026 08:32:29","ID":"1151","Подразделения":"Управление закупок"}
,
{"Логин":"ermokhinma","Активность":"Да","Дата изменения":"24.06.2026 16:10:03","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"ErmokhinMA@mos.ru","Дата регистрации":"28.05.2026 15:17:11","Последняя авторизация":"24.06.2026 13:12:09","ID":"1149","Подразделения":""}
,
{"Логин":"user_1146","Активность":"Да","Дата изменения":"06.08.2026 04:02:46","Имя":"Анжелика","Фамилия":"Черкас","Внешний код":"d381a7a0-5915-11f1-b221-00155d000912","E-Mail":"CherkasAA@it.mos.ru","Дата регистрации":"28.05.2026 04:01:47","Последняя авторизация":"05.08.2026 20:18:49","ID":"1146","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"VanyushkinaDV","Активность":"Да","Дата изменения":"06.08.2026 05:36:22","Имя":"Дарья","Фамилия":"Ванюшкина","Внешний код":"25bc7ead-584a-11f1-b220-00155d000910","E-Mail":"VanyushkinaDV@it.mos.ru","Дата регистрации":"27.05.2026 15:15:11","Последняя авторизация":"","ID":"1143","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"ZhabovskayaEA","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Екатерина","Фамилия":"Жабовская","Внешний код":"c0626ac3-5800-11f1-b220-00155d000910","E-Mail":"ZhabovskayaEA@mos.ru","Дата регистрации":"21.05.2026 15:04:21","Последняя авторизация":"10.08.2026 09:35:47","ID":"1122","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"KlimovaZK","Активность":"Да","Дата изменения":"27.07.2026 17:17:05","Имя":"Залина","Фамилия":"Климова","Внешний код":"","E-Mail":"klimovazk@mos.ru","Дата регистрации":"21.05.2026 03:03:03","Последняя авторизация":"","ID":"1121","Подразделения":"Комитет"}
,
{"Логин":"BondarenkoNA","Активность":"Да","Дата изменения":"04.08.2026 17:33:06","Имя":"Наталья","Фамилия":"Бондаренко","Внешний код":"7c08d582-5417-11f1-b21b-00155d000912","E-Mail":"BondarenkoNA7@mos.ru","Дата регистрации":"20.05.2026 15:02:18","Последняя авторизация":"04.08.2026 09:34:07","ID":"1119","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"Cavjob23@ya.ru","Активность":"Да","Дата изменения":"02.06.2026 12:01:44","Имя":"Иван","Фамилия":"Иванов","Внешний код":"","E-Mail":"cavjob@ya.ru","Дата регистрации":"19.05.2026 21:13:48","Последняя авторизация":"16.06.2026 01:32:10","ID":"1118","Подразделения":"Комитет"}
,
{"Логин":"FilenkoIV@mos.ru","Активность":"Да","Дата изменения":"27.07.2026 10:53:25","Имя":"Иван","Фамилия":"Филенко","Внешний код":"8da4d5a7-42c7-11f1-b205-00155d000912","E-Mail":"FilenkoIV@mos.ru","Дата регистрации":"15.05.2026 16:52:58","Последняя авторизация":"10.08.2026 14:45:50","ID":"1117","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"SaakyanZK","Активность":"Да","Дата изменения":"06.08.2026 17:37:08","Имя":"Жанна","Фамилия":"Саакян","Внешний код":"e2f3c8a0-4e97-11f1-b214-00155d000910","E-Mail":"SaakyanZK@mos.ru","Дата регистрации":"13.05.2026 02:48:07","Последняя авторизация":"11.08.2026 07:30:02","ID":"1116","Подразделения":"Управление развития коммерческих партнерств"}
,
{"Логин":"ErgakovaM","Активность":"Да","Дата изменения":"04.08.2026 17:33:05","Имя":"Мария","Фамилия":"Ергакова","Внешний код":"e2cbfff1-2042-11ec-ab4d-00155d051a08","E-Mail":"klukvik5@mail.ru","Дата регистрации":"13.05.2026 02:48:06","Последняя авторизация":"04.08.2026 15:49:09","ID":"1115","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"GryzhinaE","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Елена","Фамилия":"Грыжина","Внешний код":"69abd16b-ee1b-11eb-ab0d-00155d051a08","E-Mail":"GryzhinaEY@mos.ru","Дата регистрации":"13.05.2026 02:48:03","Последняя авторизация":"04.08.2026 16:27:36","ID":"1114","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"ValimukhametovYR","Активность":"Да","Дата изменения":"04.08.2026 17:33:06","Имя":"Юлдаш","Фамилия":"Валимухаметов","Внешний код":"81e1caff-4888-11f1-b20c-00155d000912","E-Mail":"ValimukhametovYR@mos.ru","Дата регистрации":"07.05.2026 02:37:03","Последняя авторизация":"04.08.2026 15:17:18","ID":"1113","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"MaslovaAI","Активность":"Да","Дата изменения":"10.08.2026 17:45:13","Имя":"Анастасия","Фамилия":"Маслова","Внешний код":"317390f3-4aa7-11f1-b20f-00155d000912","E-Mail":"MaslovaAI2@mos.ru","Дата регистрации":"06.05.2026 14:36:06","Последняя авторизация":"10.08.2026 09:02:28","ID":"1112","Подразделения":"Управление взаиморасчетов с контрагентами"}
,
{"Логин":"SamoylovaPY","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Полина","Фамилия":"Самойлова","Внешний код":"37cf2c4d-484d-11f1-b20c-00155d000912","E-Mail":"SamoylovaPY@mos.ru","Дата регистрации":"05.05.2026 13:42:21","Последняя авторизация":"10.08.2026 09:12:09","ID":"1111","Подразделения":"Управление закупок"}
,
{"Логин":"VasilovVV","Активность":"Да","Дата изменения":"06.08.2026 17:37:08","Имя":"Владислав","Фамилия":"Василов","Внешний код":"f53eadbe-4781-11f1-b20b-00155d000912","E-Mail":"VasilovVV@mos.ru","Дата регистрации":"30.04.2026 14:24:15","Последняя авторизация":"10.08.2026 16:01:26","ID":"1110","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"GrigorevaAS","Активность":"Да","Дата изменения":"04.08.2026 05:32:08","Имя":"Алина","Фамилия":"Григорьева","Внешний код":"da8ca54c-478b-11f1-b20b-00155d000912","E-Mail":"GrigorevaAS6@mos.ru","Дата регистрации":"30.04.2026 14:24:04","Последняя авторизация":"06.08.2026 10:13:29","ID":"1109","Подразделения":"Управление развития коммерческих партнерств"}
,
{"Логин":"BulgakovVN","Активность":"Да","Дата изменения":"06.08.2026 05:36:22","Имя":"Валентин","Фамилия":"Булгаков","Внешний код":"d2e96678-438c-11f1-b206-00155d000910","E-Mail":"BulgakovVN1@mos.ru","Дата регистрации":"28.04.2026 02:19:02","Последняя авторизация":"29.04.2026 09:17:14","ID":"1102","Подразделения":"Группа по развитию туристической продукции"}
,
{"Логин":"UsovaMS","Активность":"Да","Дата изменения":"05.06.2026 15:32:17","Имя":"Мария","Фамилия":"Усова","Внешний код":"","E-Mail":"UsovaMS@mos.ru","Дата регистрации":"27.04.2026 14:18:17","Последняя авторизация":"21.05.2026 15:57:23","ID":"1101","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"BarlovaAO","Активность":"Да","Дата изменения":"06.08.2026 05:36:21","Имя":"Александра","Фамилия":"Барлова","Внешний код":"507a460c-4201-11f1-b204-00155d000910","E-Mail":"BarlovaAO@mos.ru","Дата регистрации":"27.04.2026 14:18:03","Последняя авторизация":"06.08.2026 13:09:00","ID":"1100","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"LitvinovaPG","Активность":"Да","Дата изменения":"09.06.2026 15:41:15","Имя":"Полина","Фамилия":"Литвинова","Внешний код":"f6531d5f-2839-11f1-b1e3-00155d000912","E-Mail":"LitvinovaPG@mos.ru","Дата регистрации":"22.04.2026 02:07:02","Последняя авторизация":"12.05.2026 17:32:25","ID":"1095","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"tsapkovskijiv","Активность":"Да","Дата изменения":"06.08.2026 17:37:08","Имя":"Иван","Фамилия":"Цапковский","Внешний код":"73c35652-3d4a-11f1-b1fe-00155d000912","E-Mail":"tsapkovskijiv@mos.ru","Дата регистрации":"20.04.2026 14:04:43","Последняя авторизация":"07.08.2026 08:45:05","ID":"1093","Подразделения":"Группа охраны труда"}
,
{"Логин":"MostovayaOY","Активность":"Да","Дата изменения":"15.07.2026 04:52:09","Имя":"Олеся","Фамилия":"Мостовая","Внешний код":"843e5df1-2903-11f1-b1e4-00155d000910","E-Mail":"MostovayaOY@mos.ru","Дата регистрации":"04.04.2026 01:34:06","Последняя авторизация":"14.07.2026 12:04:11","ID":"1090","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"ZarenkovaA","Активность":"Да","Дата изменения":"17.07.2026 16:57:11","Имя":"Анфиса","Фамилия":"Заренкова","Внешний код":"1298e737-31b6-11f1-b1ef-00155d000912","E-Mail":"ZarenkovaA@mos.ru","Дата регистрации":"04.04.2026 01:34:06","Последняя авторизация":"","ID":"1091","Подразделения":"Дирекция территориального маркетинга"}
,
{"Логин":"IbraimovaLE","Активность":"Да","Дата изменения":"09.06.2026 15:41:14","Имя":"Лейла","Фамилия":"Ибраимова","Внешний код":"ec0a9640-2da1-11f1-b1ea-00155d000910","E-Mail":"IbraimovaLE@mos.ru","Дата регистрации":"04.04.2026 01:34:05","Последняя авторизация":"","ID":"1088","Подразделения":"Управление дизайна"}
,
{"Логин":"LevkinaES","Активность":"Да","Дата изменения":"29.07.2026 17:21:06","Имя":"Евгения","Фамилия":"Лёвкина","Внешний код":"d24a2204-2902-11f1-b1e4-00155d000910","E-Mail":"LevkinaES@mos.ru","Дата регистрации":"04.04.2026 01:34:05","Последняя авторизация":"29.07.2026 11:39:41","ID":"1089","Подразделения":"Дирекция территориального маркетинга"}
,
{"Логин":"AsonovaSO","Активность":"Да","Дата изменения":"21.07.2026 05:04:05","Имя":"Софья","Фамилия":"Асонова","Внешний код":"cd6c0680-2904-11f1-b1e4-00155d000910","E-Mail":"AsonovaSO@mos.ru","Дата регистрации":"04.04.2026 01:34:02","Последняя авторизация":"","ID":"1087","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"ZolotarevAV","Активность":"Да","Дата изменения":"03.08.2026 17:31:13","Имя":"Александр","Фамилия":"Золотарев","Внешний код":"0e3f12a7-2847-11f1-b1e3-00155d000912","E-Mail":"zolotarevav4@mos.ru","Дата регистрации":"02.04.2026 01:30:06","Последняя авторизация":"08.08.2026 02:59:33","ID":"1086","Подразделения":"Дирекция аналитики и исследований"}
,
{"Логин":"RyabovaOA","Активность":"Да","Дата изменения":"16.07.2026 16:55:09","Имя":"Олеся","Фамилия":"Рябова","Внешний код":"186688b9-2e6b-11f1-b1eb-00155d000910","E-Mail":"RyabovaOA5@mos.ru","Дата регистрации":"02.04.2026 01:30:03","Последняя авторизация":"16.07.2026 09:47:48","ID":"1085","Подразделения":"Управление дизайна"}
,
{"Логин":"TkachevED","Активность":"Да","Дата изменения":"10.08.2026 17:45:13","Имя":"Егор","Фамилия":"Ткачев","Внешний код":"62cceee3-2848-11f1-b1e3-00155d000912","E-Mail":"tkacheved@mos.ru","Дата регистрации":"01.04.2026 13:29:38","Последняя авторизация":"10.08.2026 15:43:20","ID":"1084","Подразделения":"Управление работы с данными и отраслевой статистики"}
,
{"Логин":"BelovII","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Илья","Фамилия":"Белов","Внешний код":"648f2c38-2849-11f1-b1e3-00155d000912","E-Mail":"belovii@mos.ru","Дата регистрации":"01.04.2026 01:28:03","Последняя авторизация":"10.08.2026 16:06:34","ID":"1083","Подразделения":"Управление аналитического сопровождения деятельности"}
,
{"Логин":"VolchkovFO","Активность":"Да","Дата изменения":"10.06.2026 03:42:15","Имя":"Фёдор","Фамилия":"Волчков","Внешний код":"05f899e8-318a-11f1-b1ef-00155d000912","E-Mail":"VolchkovFO@mos.ru","Дата регистрации":"31.03.2026 13:27:39","Последняя авторизация":"25.05.2026 09:58:11","ID":"1082","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"UdalovKA","Активность":"Да","Дата изменения":"28.07.2026 17:19:05","Имя":"Кирилл","Фамилия":"Удалов","Внешний код":"ef393165-283f-11f1-b1e3-00155d000912","E-Mail":"udalovka@mos.ru","Дата регистрации":"28.03.2026 01:21:08","Последняя авторизация":"28.07.2026 13:22:03","ID":"1081","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"stepankoav","Активность":"Да","Дата изменения":"03.08.2026 17:31:13","Имя":"Анастасия","Фамилия":"Степанько","Внешний код":"fea04f60-2843-11f1-b1e3-00155d000912","E-Mail":"stepankoav@mos.ru","Дата регистрации":"28.03.2026 01:21:06","Последняя авторизация":"03.08.2026 08:40:22","ID":"1080","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"SemenikhinaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:13","Имя":"Анна","Фамилия":"Семенихина","Внешний код":"68361432-2845-11f1-b1e3-00155d000912","E-Mail":"semenikhinaaa1@mos.ru","Дата регистрации":"27.03.2026 13:20:31","Последняя авторизация":"10.08.2026 14:35:14","ID":"1079","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"borodovskayasm","Активность":"Да","Дата изменения":"10.08.2026 17:45:13","Имя":"София","Фамилия":"Бородовская","Внешний код":"bd3590ae-283b-11f1-b1e3-00155d000912","E-Mail":"borodovskayasm@mos.ru","Дата регистрации":"27.03.2026 01:19:04","Последняя авторизация":"10.08.2026 16:34:58","ID":"1078","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"kupriyanovaeg","Активность":"Да","Дата изменения":"03.08.2026 17:31:13","Имя":"Елена","Фамилия":"Куприянова","Внешний код":"5cb833f0-2836-11f1-b1e3-00155d000912","E-Mail":"kupriyanovaeg@mos.ru","Дата регистрации":"26.03.2026 13:18:15","Последняя авторизация":"10.08.2026 14:15:00","ID":"1077","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"GavrilovaIA","Активность":"Да","Дата изменения":"04.08.2026 05:32:08","Имя":"Ирина","Фамилия":"Гаврилова","Внешний код":"0b94f924-2103-11f1-b1da-00155d000912","E-Mail":"GavrilovaIA2@mos.ru","Дата регистрации":"13.03.2026 12:54:05","Последняя авторизация":"06.08.2026 12:02:13","ID":"1074","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"user_1071","Активность":"Да","Дата изменения":"11.08.2026 04:02:58","Имя":"Михаил","Фамилия":"Сироткин","Внешний код":"20785686-114c-11f1-b1c5-00155d000912","E-Mail":"sirotkinms1@mos.ru","Дата регистрации":"03.03.2026 04:04:45","Последняя авторизация":"23.07.2026 15:57:45","ID":"1071","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"OrudinDE","Активность":"Да","Дата изменения":"04.08.2026 05:32:07","Имя":"Даниил","Фамилия":"Орудин","Внешний код":"d84f253d-1610-11f1-b1cb-00155d000912","E-Mail":"OrudinDE@mos.ru","Дата регистрации":"03.03.2026 00:34:03","Последняя авторизация":"10.08.2026 13:56:33","ID":"1070","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"EfimovSY","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Сергей","Фамилия":"Ефимов","Внешний код":"15c8b8db-16c6-11f1-b1cc-00155d000912","E-Mail":"EfimovSY5@mos.ru","Дата регистрации":"03.03.2026 00:34:02","Последняя авторизация":"20.04.2026 13:02:50","ID":"1069","Подразделения":"Дирекция по развитию коммерческих продуктов"}
,
{"Логин":"PasuginovaMG","Активность":"Да","Дата изменения":"10.08.2026 17:45:13","Имя":"Мария","Фамилия":"Пасугинова","Внешний код":"adc9c4af-160a-11f1-b1cb-00155d000912","E-Mail":"PasuginovaMG@mos.ru","Дата регистрации":"02.03.2026 12:33:16","Последняя авторизация":"11.08.2026 08:52:57","ID":"1067","Подразделения":"Дирекция по работе со странами Азии, СНГ и Латинской Америки"}
,
{"Логин":"SobolevaYA","Активность":"Да","Дата изменения":"11.08.2026 05:46:10","Имя":"Юлия","Фамилия":"Соболева","Внешний код":"b41b9cde-1601-11f1-b1cb-00155d000912","E-Mail":"SobolevaYA3@mos.ru","Дата регистрации":"26.02.2026 12:25:17","Последняя авторизация":"10.08.2026 17:50:48","ID":"1065","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"YaschukEA","Активность":"Да","Дата изменения":"28.07.2026 17:19:05","Имя":"Евгений","Фамилия":"Ящук","Внешний код":"3d347425-0b09-11f1-b1bd-00155d000912","E-Mail":"YaschukEA@mos.ru","Дата регистрации":"19.02.2026 12:12:34","Последняя авторизация":"06.08.2026 11:09:41","ID":"1061","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"IldisAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:13","Имя":"Алина","Фамилия":"Илдис","Внешний код":"9d72c33f-0d67-11f1-b1c0-00155d000910","E-Mail":"IldisAA@mos.ru","Дата регистрации":"18.02.2026 12:16:20","Последняя авторизация":"10.08.2026 11:28:43","ID":"1057","Подразделения":"Управление развития корпоративной культуры и мотивации персонала"}
,
{"Логин":"KrotovaNA","Активность":"Да","Дата изменения":"03.08.2026 17:31:13","Имя":"Наталья","Фамилия":"Кротова","Внешний код":"3fc7ffdd-0bca-11f1-b1be-00155d000912","E-Mail":"KrotovaNA4@mos.ru","Дата регистрации":"16.02.2026 12:16:36","Последняя авторизация":"10.08.2026 09:56:41","ID":"1055","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"KasnitskayaVN","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Виктория","Фамилия":"Касницкая","Внешний код":"5f3c4cc1-0b00-11f1-b1bd-00155d000912","E-Mail":"KasnitskayaVN@mos.ru","Дата регистрации":"13.02.2026 15:13:21","Последняя авторизация":"10.08.2026 17:18:58","ID":"1054","Подразделения":"Управление по взаимодействию с органами власти"}
,
{"Логин":"LukoyanovAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Алексей","Фамилия":"Лукоянов","Внешний код":"c6d9a753-071b-11f1-b1b8-00155d000910","E-Mail":"LukoyanovAA1@mos.ru","Дата регистрации":"10.02.2026 16:28:36","Последняя авторизация":"10.08.2026 11:59:41","ID":"1051","Подразделения":"Группа технической поддержки"}
,
{"Логин":"PirozhkovIA","Активность":"Да","Дата изменения":"04.08.2026 17:33:06","Имя":"Илья","Фамилия":"Пирожков","Внешний код":"8d2b40b7-0583-11f1-b1b6-00155d000912","E-Mail":"PirozhkovIA@mos.ru","Дата регистрации":"09.02.2026 12:11:59","Последняя авторизация":"22.07.2026 16:03:50","ID":"1048","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"KlimovaZK@mos.ru","Активность":"Да","Дата изменения":"27.07.2026 15:22:37","Имя":"Залина","Фамилия":"Климова","Внешний код":"","E-Mail":"KlimovaZK@mos.ru","Дата регистрации":"04.02.2026 21:43:59","Последняя авторизация":"10.08.2026 16:35:15","ID":"1013","Подразделения":"Комитет"}
,
{"Логин":"KislenkoOV","Активность":"Да","Дата изменения":"31.07.2026 17:25:04","Имя":"Оксана","Фамилия":"Кисленко","Внешний код":"","E-Mail":"KislenkoOV@mos.ru","Дата регистрации":"04.02.2026 21:08:14","Последняя авторизация":"10.08.2026 11:52:55","ID":"1011","Подразделения":"Управление закупок"}
,
{"Логин":"ViktorovaES","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Екатерина","Фамилия":"Викторова","Внешний код":"45013630-0001-11f1-b1af-00155d000912","E-Mail":"ViktorovaES2@mos.ru","Дата регистрации":"04.02.2026 10:03:46","Последняя авторизация":"11.08.2026 08:47:46","ID":"936","Подразделения":"Управление по взаимодействию с органами власти"}
,
{"Логин":"KushnerevichOL","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Олеся","Фамилия":"Кушнеревич","Внешний код":"34aaf005-00cb-11f1-b1b0-00155d000910","E-Mail":"kushnerevichol@mos.ru","Дата регистрации":"04.02.2026 09:09:20","Последняя авторизация":"10.08.2026 17:00:42","ID":"935","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"DrozdOA","Активность":"Да","Дата изменения":"06.08.2026 05:36:21","Имя":"Ольга","Фамилия":"Дрозд","Внешний код":"5ffb2293-0007-11f1-b1af-00155d000912","E-Mail":"DrozdOA@mos.ru","Дата регистрации":"30.01.2026 13:58:02","Последняя авторизация":"10.08.2026 10:59:56","ID":"931","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"NeganovDA","Активность":"Да","Дата изменения":"15.07.2026 04:52:08","Имя":"Дмитрий","Фамилия":"Неганов","Внешний код":"f03fe76a-fa8b-11f0-b1a8-00155d000910","E-Mail":"NeganovDA1@mos.ru","Дата регистрации":"23.01.2026 13:43:07","Последняя авторизация":"","ID":"930","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"user_929","Активность":"Да","Дата изменения":"17.01.2026 04:09:11","Имя":"Юлия","Фамилия":"Тарасова","Внешний код":"4a9d637a-f1e8-11f0-b19d-00155d000910","E-Mail":"juotchepkova@mail.ru","Дата регистрации":"16.01.2026 04:01:19","Последняя авторизация":"","ID":"929","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_927","Активность":"Да","Дата изменения":"05.02.2026 04:04:08","Имя":"Мария","Фамилия":"Щевьева","Внешний код":"7eb21b47-f04b-11f0-b19b-00155d000910","E-Mail":"shchevevamv@mos.ru","Дата регистрации":"14.01.2026 04:09:17","Последняя авторизация":"","ID":"927","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"RepinVA","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Виктор","Фамилия":"Репин","Внешний код":"482bbe96-f044-11f0-b19b-00155d000910","E-Mail":"RepinVA2@mos.ru","Дата регистрации":"14.01.2026 01:22:03","Последняя авторизация":"05.08.2026 13:57:54","ID":"926","Подразделения":"Управление по развитию коммерческих продуктов"}
,
{"Логин":"FilippovAI","Активность":"Да","Дата изменения":"24.07.2026 17:11:05","Имя":"Алексей","Фамилия":"Филиппов","Внешний код":"7c69b30e-f11a-11f0-b19c-00155d000912","E-Mail":"FilippovAI1@mos.ru","Дата регистрации":"13.01.2026 13:21:08","Последняя авторизация":"24.07.2026 12:32:46","ID":"925","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"AntyukhovaL","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Лилия","Фамилия":"Антюхова","Внешний код":"f30ff402-c3ca-11ed-ad85-00155d000912","E-Mail":"antyukhovalr2@mos.ru","Дата регистрации":"17.12.2025 00:32:02","Последняя авторизация":"07.08.2026 11:30:47","ID":"923","Подразделения":"Управление по развитию гостиничной инфраструктуры"}
,
{"Логин":"user_922","Активность":"Да","Дата изменения":"06.08.2026 04:02:44","Имя":"Валерия","Фамилия":"Беликова","Внешний код":"fc85337c-d724-11f0-b17b-00155d000912","E-Mail":"lerika-2000@yandex.ru","Дата регистрации":"13.12.2025 04:01:15","Последняя авторизация":"","ID":"922","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"TimakovaMS","Активность":"Да","Дата изменения":"30.07.2026 17:23:05","Имя":"Маргарита","Фамилия":"Тимакова","Внешний код":"91eba1a2-9bba-11ed-ad50-00155d000912","E-Mail":"timakovams1@mos.ru","Дата регистрации":"10.12.2025 00:18:05","Последняя авторизация":"30.07.2026 12:54:53","ID":"921","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"KalistratovIA","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Илья","Фамилия":"Калистратов","Внешний код":"f2f3e445-d59a-11f0-b179-00155d000912","E-Mail":"KalistratovIA1@mos.ru","Дата регистрации":"09.12.2025 12:17:04","Последняя авторизация":"23.07.2026 16:06:43","ID":"920","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"SemenovSI","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Сергей","Фамилия":"Семенов","Внешний код":"48f8e4de-d01a-11f0-b172-00155d000912","E-Mail":"SemenovSI4@mos.ru","Дата регистрации":"03.12.2025 00:05:04","Последняя авторизация":"03.12.2025 13:47:14","ID":"919","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"DolganovaTV","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Татьяна","Фамилия":"Долганова","Внешний код":"1babb84e-cf4a-11f0-b171-00155d000912","E-Mail":"DolganovaTV@mos.ru","Дата регистрации":"02.12.2025 00:03:03","Последняя авторизация":"04.08.2026 10:25:48","ID":"917","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"GorbunovVS","Активность":"Да","Дата изменения":"15.07.2026 04:52:08","Имя":"Владимир","Фамилия":"Горбунов","Внешний код":"297e55ea-ce97-11f0-b170-00155d000912","E-Mail":"GorbunovVS1@mos.ru","Дата регистрации":"27.11.2025 23:55:07","Последняя авторизация":"17.03.2026 08:18:58","ID":"916","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"ButorinYI","Активность":"Да","Дата изменения":"09.08.2026 05:42:06","Имя":"Юрий","Фамилия":"Буторин","Внешний код":"0b2c756f-ce84-11f0-b170-00155d000912","E-Mail":"ButorinYI@mos.ru","Дата регистрации":"27.11.2025 23:55:03","Последняя авторизация":"23.07.2026 09:54:50","ID":"915","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"MelnichenkoNS","Активность":"Да","Дата изменения":"30.07.2026 17:23:12","Имя":"Наталья","Фамилия":"Мельниченко","Внешний код":"43d219fc-c900-11f0-b167-00155d000912","E-Mail":"MelnichenkoNS1@mos.ru","Дата регистрации":"21.11.2025 23:43:05","Последняя авторизация":"31.07.2026 14:34:00","ID":"913","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"ArnautovaAE","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Александра","Фамилия":"Арнаутова","Внешний код":"94ab771e-ca97-11f0-b169-00155d000910","E-Mail":"ArnautovaAE@mos.ru","Дата регистрации":"21.11.2025 23:43:02","Последняя авторизация":"11.08.2026 07:56:08","ID":"912","Подразделения":"Группа технической поддержки"}
,
{"Логин":"SokolovAV","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Алексей","Фамилия":"Соколов","Внешний код":"1dee8c6e-c5f2-11f0-b163-00155d000910","E-Mail":"SokolovAV26@mos.ru","Дата регистрации":"19.11.2025 23:39:03","Последняя авторизация":"11.08.2026 08:57:15","ID":"911","Подразделения":"Управление развития корпоративной культуры и мотивации персонала"}
,
{"Логин":"user_910","Активность":"Да","Дата изменения":"05.05.2026 13:33:18","Имя":"Илья","Фамилия":"Картузов","Внешний код":"acaa8afc-c06a-11f0-b15c-00155d000912","E-Mail":"kartuzovie@mos.ru","Дата регистрации":"18.11.2025 04:01:44","Последняя авторизация":"23.07.2026 14:33:26","ID":"910","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"DavydovaDA","Активность":"Да","Дата изменения":"11.08.2026 05:46:09","Имя":"Дина","Фамилия":"Давыдова","Внешний код":"d39b6304-be0a-11f0-b159-00155d000912","E-Mail":"DavydovaDA4@mos.ru","Дата регистрации":"10.11.2025 15:57:09","Последняя авторизация":"31.07.2026 15:16:21","ID":"909","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"KorolevaKS","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Ксения","Фамилия":"Королева","Внешний код":"6e402800-bba4-11f0-b156-00155d000910","E-Mail":"KorolevaKS1@mos.ru","Дата регистрации":"07.11.2025 23:15:03","Последняя авторизация":"10.08.2026 16:13:10","ID":"908","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"ChaykaDA","Активность":"Да","Дата изменения":"29.07.2026 05:20:08","Имя":"Диана","Фамилия":"Чайка","Внешний код":"6f093c52-be02-11f0-b159-00155d000912","E-Mail":"ChaykaDA@mos.ru","Дата регистрации":"06.11.2025 23:13:02","Последняя авторизация":"11.08.2026 08:58:50","ID":"907","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"AnisimovaAD","Активность":"Да","Дата изменения":"03.08.2026 17:31:12","Имя":"Александра","Фамилия":"Анисимова","Внешний код":"3ba86ee8-ba11-11f0-b154-00155d000910","E-Mail":"AnisimovaAD2@mos.ru","Дата регистрации":"05.11.2025 23:11:02","Последняя авторизация":"06.08.2026 17:36:56","ID":"905","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"KhabibullinaAK","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Алиса","Фамилия":"Хабибуллина","Внешний код":"fffdf58f-b498-11f0-b14d-00155d000910","E-Mail":"KhabibullinaAK@mos.ru","Дата регистрации":"29.10.2025 22:58:03","Последняя авторизация":"10.08.2026 11:27:19","ID":"901","Подразделения":"Группа взаимодействия с международными социальными сетями"}
,
{"Логин":"user_900","Активность":"Да","Дата изменения":"05.08.2026 19:17:48","Имя":"Алиса","Фамилия":"Хабибуллина","Внешний код":"fffdf58f-b498-11f0-b14d-00155d000910","E-Mail":"KhabibullinaAK@mos.ru","Дата регистрации":"29.10.2025 12:43:17","Последняя авторизация":"","ID":"900","Подразделения":"Группа взаимодействия с международными социальными сетями"}
,
{"Логин":"KallaurOY","Активность":"Да","Дата изменения":"16.06.2026 15:55:07","Имя":"Ольга","Фамилия":"Каллаур","Внешний код":"1c4c337e-a8d3-11f0-b13e-00155d000910","E-Mail":"KallaurOY@mos.ru","Дата регистрации":"27.10.2025 15:54:01","Последняя авторизация":"22.04.2026 17:15:25","ID":"899","Подразделения":"Управление дизайна"}
,
{"Логин":"BurkovaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Алина","Фамилия":"Буркова","Внешний код":"f2af5e4a-ad7e-11f0-b144-00155d000912","E-Mail":"BurkovaAA@mos.ru","Дата регистрации":"27.10.2025 15:53:57","Последняя авторизация":"10.08.2026 09:15:40","ID":"897","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"ZhukovAS","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Андрей","Фамилия":"Жуков","Внешний код":"f187d66e-b304-11f0-b14b-00155d000910","E-Mail":"ZhukovAS11@mos.ru","Дата регистрации":"27.10.2025 14:00:14","Последняя авторизация":"10.08.2026 16:12:32","ID":"895","Подразделения":"Группа IOS-разработки"}
,
{"Логин":"user_885","Активность":"Да","Дата изменения":"29.07.2026 04:02:46","Имя":"Владимир","Фамилия":"Панов","Внешний код":"45dc113a-9787-11f0-b128-00155d000912","E-Mail":"panoff.2000@yandex.ru","Дата регистрации":"23.09.2025 04:01:27","Последняя авторизация":"","ID":"885","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"KardapolovaTA","Активность":"Да","Дата изменения":"10.08.2026 17:45:12","Имя":"Татьяна","Фамилия":"Кардаполова","Внешний код":"37f5f189-9846-11f0-b129-00155d000912","E-Mail":"KardapolovaTA@mos.ru","Дата регистрации":"19.09.2025 21:41:02","Последняя авторизация":"10.08.2026 15:45:13","ID":"883","Подразделения":"Группа по работе с Китаем и СНГ"}
,
{"Логин":"YushkoKD","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Кирилл","Фамилия":"Юшко","Внешний код":"4c5c7abb-8ed8-11f0-b11d-00155d000910","E-Mail":"YushkoKD@mos.ru","Дата регистрации":"11.09.2025 21:25:08","Последняя авторизация":"06.08.2026 12:15:27","ID":"881","Подразделения":"Проектная группа"}
,
{"Логин":"TitovaES","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Елизавета","Фамилия":"Титова","Внешний код":"4e76da36-8e14-11f0-b11c-00155d000910","E-Mail":"TitovaES1@mos.ru","Дата регистрации":"08.09.2025 21:19:07","Последняя авторизация":"10.08.2026 09:17:18","ID":"878","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"GogolYS","Активность":"Да","Дата изменения":"03.08.2026 17:31:12","Имя":"Яна","Фамилия":"Гоголь","Внешний код":"f1cfb2b6-8c82-11f0-b11a-00155d000912","E-Mail":"GogolYS@mos.ru","Дата регистрации":"04.09.2025 21:13:02","Последняя авторизация":"10.08.2026 14:41:58","ID":"875","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"OgayIA","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Игорь","Фамилия":"Огай","Внешний код":"bb1f6688-87c6-11f0-b114-00155d000912","E-Mail":"ogayia@mos.ru","Дата регистрации":"02.09.2025 21:09:02","Последняя авторизация":"10.08.2026 12:30:55","ID":"874","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"user_873","Активность":"Да","Дата изменения":"29.07.2026 04:02:46","Имя":"Василиса","Фамилия":"Кузьмичева","Внешний код":"1f9ee891-86fd-11f0-b113-00155d000912","E-Mail":"vasilisa88@yahoo.com","Дата регистрации":"02.09.2025 04:01:13","Последняя авторизация":"20.04.2026 09:17:09","ID":"873","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"VezhlevNA","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Николай","Фамилия":"Вежлев","Внешний код":"2446ddff-8717-11f0-b113-00155d000912","E-Mail":"VezhlevNA@mos.ru","Дата регистрации":"28.08.2025 20:59:06","Последняя авторизация":"10.08.2026 13:43:01","ID":"871","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KandybaDD","Активность":"Да","Дата изменения":"31.07.2026 17:25:05","Имя":"Дарья","Фамилия":"Кандыба","Внешний код":"e598df3f-8702-11f0-b113-00155d000912","E-Mail":"KandybaDD@mos.ru","Дата регистрации":"28.08.2025 20:59:03","Последняя авторизация":"29.07.2026 17:37:47","ID":"870","Подразделения":"Управление проектирования интерфейсов"}
,
{"Логин":"AksentevaSA","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Светлана","Фамилия":"Аксентьева","Внешний код":"da065527-8186-11f0-b10c-00155d000912","E-Mail":"AksentevaSA@mos.ru","Дата регистрации":"25.08.2025 20:53:02","Последняя авторизация":"10.08.2026 09:50:44","ID":"867","Подразделения":"Проектная группа"}
,
{"Логин":"ZagarinaIN","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Ирина","Фамилия":"Загарина","Внешний код":"16e06857-817d-11f0-b10c-00155d000912","E-Mail":"ZagarinaIN@mos.ru","Дата регистрации":"22.08.2025 20:47:03","Последняя авторизация":"10.08.2026 09:01:11","ID":"866","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"AksenovaAA","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Алина","Фамилия":"Аксёнова","Внешний код":"d10e337f-7ccf-11f0-b106-00155d000912","E-Mail":"AksenovaAA2@mos.ru","Дата регистрации":"19.08.2025 18:44:24","Последняя авторизация":"10.08.2026 14:53:56","ID":"863","Подразделения":"Управление по развитию образовательного и детского туризма"}
,
{"Логин":"user_862","Активность":"Да","Дата изменения":"11.08.2026 04:01:40","Имя":"Татьяна","Фамилия":"Аншакова","Внешний код":"b63237f6-92e3-11ec-abe0-00155d051a08","E-Mail":"AnshakovaTG@mos.ru","Дата регистрации":"16.08.2025 04:01:16","Последняя авторизация":"","ID":"862","Подразделения":"Правовое управление"}
,
{"Логин":"user_861","Активность":"Да","Дата изменения":"11.08.2026 04:01:38","Имя":"Екатерина","Фамилия":"Скакун","Внешний код":"190f65b7-a683-11eb-aab3-00155d1a381f","E-Mail":"ekaterina-alexandrovna1993@rambler.ru","Дата регистрации":"14.08.2025 04:01:09","Последняя авторизация":"24.07.2026 11:54:33","ID":"861","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_859","Активность":"Да","Дата изменения":"11.08.2026 04:02:56","Имя":"Тимур","Фамилия":"Хайртдинов","Внешний код":"3d3f480f-7358-11f0-b0fa-00155d000912","E-Mail":"radyrabochaya@mail.ru","Дата регистрации":"08.08.2025 04:01:01","Последняя авторизация":"10.08.2026 17:45:35","ID":"859","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"YanovskiyNV","Активность":"Да","Дата изменения":"03.08.2026 17:31:12","Имя":"Никита","Фамилия":"Яновский","Внешний код":"6a9c0799-71c7-11f0-b0f8-00155d000910","E-Mail":"YanovskiyNV@mos.ru","Дата регистрации":"05.08.2025 15:20:56","Последняя авторизация":"10.08.2026 09:32:08","ID":"855","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"PotoshovaPR","Активность":"Да","Дата изменения":"06.08.2026 05:36:19","Имя":"Полина","Фамилия":"Потошова","Внешний код":"2f682152-710e-11f0-b0f7-00155d000912","E-Mail":"PotoshovaPR1@mos.ru","Дата регистрации":"04.08.2025 20:13:04","Последняя авторизация":"09.08.2026 11:31:43","ID":"854","Подразделения":"Группа технической поддержки"}
,
{"Логин":"ShakhovskayaMS","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Мария","Фамилия":"Шаховская","Внешний код":"3373e15b-7f44-11f0-b109-00155d000912","E-Mail":"ShakhovskayaMS@mos.ru","Дата регистрации":"01.08.2025 20:08:04","Последняя авторизация":"10.08.2026 09:04:29","ID":"850","Подразделения":"Правовое управление"}
,
{"Логин":"BorisovDM","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"Дмитрий","Фамилия":"Борисов","Внешний код":"f26ec3fd-72a8-11f0-b0f9-00155d000912","E-Mail":"BorisovDM@mos.ru","Дата регистрации":"01.08.2025 20:08:03","Последняя авторизация":"10.08.2026 08:46:29","ID":"849","Подразделения":"Группа реализации"}
,
{"Логин":"ApenyanskayaSV","Активность":"Да","Дата изменения":"10.08.2026 17:45:11","Имя":"София","Фамилия":"Апенянская","Внешний код":"9cda7961-7102-11f0-b0f7-00155d000912","E-Mail":"ApenyanskayaSV@mos.ru","Дата регистрации":"01.08.2025 20:08:02","Последняя авторизация":"11.08.2026 08:46:21","ID":"848","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"AntipovaEA","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Екатерина","Фамилия":"Антипова","Внешний код":"57033d32-6d0f-11f0-b0f2-00155d000912","E-Mail":"AntipovaEA5@mos.ru","Дата регистрации":"30.07.2025 20:04:02","Последняя авторизация":"07.08.2026 17:13:07","ID":"847","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"FedorovaAA","Активность":"Да","Дата изменения":"27.07.2026 17:17:10","Имя":"Алина","Фамилия":"Строгонова","Внешний код":"97e5f352-6c46-11f0-b0f1-00155d000910","E-Mail":"FedorovaAA2@mos.ru","Дата регистрации":"29.07.2025 17:25:59","Последняя авторизация":"27.07.2026 10:33:07","ID":"846","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"TamaevaRA","Активность":"Да","Дата изменения":"06.08.2026 05:36:19","Имя":"Радимхан","Фамилия":"Тамаева","Внешний код":"b4e96a79-678e-11f0-b0ea-00155d000912","E-Mail":"TamaevaRA@mos.ru","Дата регистрации":"23.07.2025 19:50:05","Последняя авторизация":"10.08.2026 17:55:05","ID":"844","Подразделения":"Управление международного продвижения"}
,
{"Логин":"PospelovSN","Активность":"Да","Дата изменения":"09.08.2026 05:42:05","Имя":"Семён","Фамилия":"Поспелов","Внешний код":"dcc051f0-6602-11f0-b0e8-00155d000912","E-Mail":"PospelovSN@mos.ru","Дата регистрации":"18.07.2025 19:40:05","Последняя авторизация":"08.08.2026 18:13:28","ID":"843","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_842","Активность":"Да","Дата изменения":"11.08.2026 04:01:44","Имя":"Яна","Фамилия":"Сапрыкина","Внешний код":"7b95158e-dfb1-11ee-aef6-00155d000910","E-Mail":"yana.saprykina.01@inbox.ru","Дата регистрации":"18.07.2025 03:59:45","Последняя авторизация":"","ID":"842","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"RusakAA","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Анна","Фамилия":"Русак","Внешний код":"6d078731-65fd-11f0-b0e8-00155d000912","E-Mail":"RusakAA@mos.ru","Дата регистрации":"17.07.2025 19:38:05","Последняя авторизация":"10.08.2026 09:16:57","ID":"841","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"SaratinaVA","Активность":"Да","Дата изменения":"22.07.2026 05:06:10","Имя":"Валентина","Фамилия":"Саратина","Внешний код":"9d39b990-6214-11f0-b0e3-00155d000912","E-Mail":"SaratinaVA@mos.ru","Дата регистрации":"14.07.2025 19:32:04","Последняя авторизация":"23.07.2026 10:22:46","ID":"840","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"UkhinaNV","Активность":"Да","Дата изменения":"31.07.2026 17:25:04","Имя":"Наталья","Фамилия":"Ухина","Внешний код":"24ef102b-607b-11f0-b0e1-00155d000912","E-Mail":"UkhinaNV@mos.ru","Дата регистрации":"14.07.2025 13:46:40","Последняя авторизация":"28.07.2026 15:19:33","ID":"838","Подразделения":"Управление работы с данными и отраслевой статистики"}
,
{"Логин":"BelyavtsevaOA","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Ольга","Фамилия":"Белявцева","Внешний код":"b0f4d1d9-607c-11f0-b0e1-00155d000912","E-Mail":"BelyavtsevaOA1@mos.ru","Дата регистрации":"11.07.2025 19:27:03","Последняя авторизация":"10.08.2026 11:11:24","ID":"837","Подразделения":"Управление по развитию коммерческих продуктов"}
,
{"Логин":"AntipovaMV","Активность":"Да","Дата изменения":"03.08.2026 17:31:12","Имя":"Мария","Фамилия":"Антипова","Внешний код":"ff3fcb71-5645-11f0-b0d4-00155d000910","E-Mail":"antipovamv7@mos.ru","Дата регистрации":"11.07.2025 19:27:02","Последняя авторизация":"11.08.2026 08:50:22","ID":"836","Подразделения":"Группа электронных продаж"}
,
{"Логин":"UstinovSN","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Станислав","Фамилия":"Устинов","Внешний код":"eb015f60-5c8f-11f0-b0dc-00155d000912","E-Mail":"UstinovSN1@mos.ru","Дата регистрации":"09.07.2025 19:23:03","Последняя авторизация":"05.08.2026 14:14:15","ID":"834","Подразделения":"Группа электронных продаж"}
,
{"Логин":"SamsonovaSP","Активность":"Да","Дата изменения":"10.08.2026 17:45:10","Имя":"Софья","Фамилия":"Самсонова","Внешний код":"e7fa36ba-5bd2-11f0-b0db-00155d000912","E-Mail":"SamsonovaSP1@mos.ru","Дата регистрации":"08.07.2025 19:21:04","Последняя авторизация":"11.08.2026 03:00:01","ID":"833","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"BelkinaED","Активность":"Да","Дата изменения":"10.08.2026 17:45:10","Имя":"Екатерина","Фамилия":"Белкина","Внешний код":"93c8dddb-5b27-11f0-b0da-00155d000910","E-Mail":"BelkinaED@mos.ru","Дата регистрации":"04.07.2025 19:14:02","Последняя авторизация":"10.08.2026 17:54:41","ID":"830","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_829","Активность":"Да","Дата изменения":"11.08.2026 04:02:55","Имя":"Римма","Фамилия":"Герхенрейдер","Внешний код":"67f7ebd4-5725-11f0-b0d5-00155d000912","E-Mail":"GerkhenreyderRM@mos.ru","Дата регистрации":"03.07.2025 04:00:53","Последняя авторизация":"13.07.2026 14:19:29","ID":"829","Подразделения":"Группа реализации"}
,
{"Логин":"GabrusevichDE","Активность":"Да","Дата изменения":"29.07.2026 05:20:07","Имя":"Дмитрий","Фамилия":"Габрусевич","Внешний код":"72f4b2ef-5c97-11f0-b0dc-00155d000912","E-Mail":"GabrusevichDE@mos.ru","Дата регистрации":"02.07.2025 19:11:02","Последняя авторизация":"05.05.2026 15:40:45","ID":"827","Подразделения":"Группа Android-разработки"}
,
{"Логин":"TarasikAV","Активность":"Да","Дата изменения":"29.05.2026 15:19:23","Имя":"Анна","Фамилия":"Тарасик","Внешний код":"","E-Mail":"TarasikAV@mos.ru","Дата регистрации":"01.07.2025 19:09:03","Последняя авторизация":"30.03.2026 11:43:31","ID":"825","Подразделения":""}
,
{"Логин":"EmelinVV","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Владимир","Фамилия":"Емелин","Внешний код":"e717d994-5b0e-11f0-b0da-00155d000910","E-Mail":"EmelinVV1@mos.ru","Дата регистрации":"01.07.2025 19:09:02","Последняя авторизация":"10.08.2026 07:52:05","ID":"824","Подразделения":"Группа технической поддержки"}
,
{"Логин":"AnshakovaYN","Активность":"Да","Дата изменения":"04.08.2026 17:33:06","Имя":"Юлия","Фамилия":"Аншакова","Внешний код":"66d1e0bd-570e-11f0-b0d5-00155d000912","E-Mail":"AnshakovaYN1@mos.ru","Дата регистрации":"30.06.2025 19:07:02","Последняя авторизация":"10.08.2026 17:10:55","ID":"823","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"ElfimovaAI","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Анастасия","Фамилия":"Елфимова","Внешний код":"f3931266-379e-11f0-b0ad-00155d000910","E-Mail":"elfimovaai@mos.ru","Дата регистрации":"26.06.2025 19:00:03","Последняя авторизация":"07.08.2026 13:38:35","ID":"821","Подразделения":"Управление работы с данными и отраслевой статистики"}
,
{"Логин":"PozhidaevRO","Активность":"Да","Дата изменения":"30.07.2026 17:23:09","Имя":"Роман","Фамилия":"Пожидаев","Внешний код":"fded8066-518a-11f0-b0ce-00155d000912","E-Mail":"PozhidaevRO@mos.ru","Дата регистрации":"24.06.2025 18:56:02","Последняя авторизация":"31.07.2026 16:51:01","ID":"820","Подразделения":"Управление закупок"}
,
{"Логин":"KazakovaAA","Активность":"Да","Дата изменения":"06.08.2026 17:37:07","Имя":"Алина","Фамилия":"Казакова","Внешний код":"acbc2fa7-5000-11f0-b0cc-00155d000910","E-Mail":"KazakovaAA3@mos.ru","Дата регистрации":"19.06.2025 18:47:03","Последняя авторизация":"06.08.2026 10:10:19","ID":"816","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"YangurskayaEA","Активность":"Да","Дата изменения":"05.08.2026 17:35:05","Имя":"Екатерина","Фамилия":"Янгурская","Внешний код":"a6ed3442-21cf-11f1-b1db-00155d000910","E-Mail":"YangurskayaEA@mos.ru","Дата регистрации":"16.06.2025 18:41:14","Последняя авторизация":"07.08.2026 14:43:11","ID":"811","Подразделения":"Группа по развитию туристической продукции"}
,
{"Логин":"GoryachevIA","Активность":"Да","Дата изменения":"04.08.2026 05:32:07","Имя":"Иван","Фамилия":"Горячев","Внешний код":"a519a6ea-3d4a-11f0-b0b4-00155d000912","E-Mail":"GoryachevIA@mos.ru","Дата регистрации":"09.06.2025 18:27:02","Последняя авторизация":"07.08.2026 09:08:21","ID":"803","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"KarevskayaAA","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Анна","Фамилия":"Каревская","Внешний код":"37fcf7f1-4045-11f0-b0b8-00155d000910","E-Mail":"KarevskayaAA@mos.ru","Дата регистрации":"06.06.2025 18:22:02","Последняя авторизация":"10.08.2026 14:21:17","ID":"801","Подразделения":"Группа электронных продаж"}
,
{"Логин":"RazuvaevaVR","Активность":"Да","Дата изменения":"27.05.2026 03:14:03","Имя":"","Фамилия":"","Внешний код":"","E-Mail":"RazuvaevaVR@mos.ru","Дата регистрации":"02.06.2025 18:14:05","Последняя авторизация":"","ID":"795","Подразделения":""}
,
{"Логин":"SolntsevaAS","Активность":"Да","Дата изменения":"06.08.2026 05:36:18","Имя":"Анастасия","Фамилия":"Солнцева","Внешний код":"f658ab9d-37ac-11f0-b0ad-00155d000910","E-Mail":"SolntsevaAS@mos.ru","Дата регистрации":"26.05.2025 18:01:06","Последняя авторизация":"","ID":"788","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"NosachevaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:10","Имя":"Анна","Фамилия":"Носачева","Внешний код":"a658b016-3a01-11f0-b0b0-00155d000910","E-Mail":"NosachevaAA@mos.ru","Дата регистрации":"23.05.2025 17:55:02","Последняя авторизация":"10.08.2026 16:55:40","ID":"784","Подразделения":"Управление закупок"}
,
{"Логин":"user_768","Активность":"Да","Дата изменения":"25.06.2026 04:03:07","Имя":"Анна","Фамилия":"Сизова","Внешний код":"3412f8b3-1e88-11f0-b08c-00155d000910","E-Mail":"SizovaAR@mos.ru","Дата регистрации":"07.05.2025 04:09:11","Последняя авторизация":"22.04.2026 16:50:35","ID":"768","Подразделения":"Управление международного продвижения"}
,
{"Логин":"user_767","Активность":"Да","Дата изменения":"12.06.2026 11:20:12","Имя":"Оксана","Фамилия":"Старовойтова","Внешний код":"b75d50c9-19c3-11f0-b086-00155d000912","E-Mail":"StarovoytovaON@mos.ru","Дата регистрации":"07.05.2025 04:09:09","Последняя авторизация":"10.08.2026 17:14:29","ID":"767","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"FedulovVV","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Вадим","Фамилия":"Федулов","Внешний код":"dfec3a2f-2979-11f0-b09a-00155d000910","E-Mail":"FedulovVV1@mos.ru","Дата регистрации":"30.04.2025 17:10:04","Последняя авторизация":"10.08.2026 10:31:21","ID":"745","Подразделения":"Управление закупок"}
,
{"Логин":"VatolinAV","Активность":"Да","Дата изменения":"10.08.2026 17:45:10","Имя":"Алексей","Фамилия":"Ватолин","Внешний код":"b95131e1-2987-11f0-b09a-00155d000910","E-Mail":"VatolinAV@mos.ru","Дата регистрации":"30.04.2025 17:10:04","Последняя авторизация":"10.08.2026 09:36:43","ID":"746","Подразделения":"Управление закупок"}
,
{"Логин":"BrusnikovMV","Активность":"Да","Дата изменения":"03.08.2026 17:31:11","Имя":"Михаил","Фамилия":"Брусников","Внешний код":"c0540eef-2982-11f0-b09a-00155d000910","E-Mail":"BrusnikovMV@mos.ru","Дата регистрации":"30.04.2025 05:09:04","Последняя авторизация":"11.08.2026 08:57:37","ID":"744","Подразделения":"Группа технической поддержки"}
,
{"Логин":"BarashkovaPS","Активность":"Да","Дата изменения":"06.08.2026 05:36:18","Имя":"Полина","Фамилия":"Барашкова","Внешний код":"afa2981a-23fc-11f0-b093-00155d000910","E-Mail":"BarashkovaPS@mos.ru","Дата регистрации":"28.04.2025 17:06:04","Последняя авторизация":"30.07.2026 15:08:59","ID":"736","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"KnyazevaEG","Активность":"Да","Дата изменения":"04.08.2026 17:33:05","Имя":"Елена","Фамилия":"Князева","Внешний код":"eba41dd9-219b-11f0-b090-00155d000912","E-Mail":"KnyazevaEG3@mos.ru","Дата регистрации":"24.04.2025 04:59:11","Последняя авторизация":"11.08.2026 08:55:39","ID":"714","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"FilipkinVV","Активность":"Да","Дата изменения":"14.07.2026 04:50:05","Имя":"Владимир","Фамилия":"Филипкин","Внешний код":"5951e685-21a8-11f0-b090-00155d000912","E-Mail":"FilipkinVV1@mos.ru","Дата регистрации":"23.04.2025 16:58:02","Последняя авторизация":"","ID":"709","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"KuznetsovaVS","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Валерия","Фамилия":"Кузнецова","Внешний код":"19dadd6c-3039-11ee-ae13-00155d000912","E-Mail":"KuznetsovaVS5@mos.ru","Дата регистрации":"22.04.2025 16:56:06","Последняя авторизация":"11.08.2026 01:18:17","ID":"705","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"ZubatovaDV","Активность":"Да","Дата изменения":"03.08.2026 17:31:11","Имя":"Дарья","Фамилия":"Зубатова","Внешний код":"ca93b190-2011-11f0-b08e-00155d000912","E-Mail":"ZubatovaDV@mos.ru","Дата регистрации":"21.04.2025 16:54:05","Последняя авторизация":"10.08.2026 18:46:36","ID":"701","Подразделения":"Управление закупок"}
,
{"Логин":"KorolevAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Андрей","Фамилия":"Королев","Внешний код":"6cd85ea8-1e82-11f0-b08c-00155d000910","E-Mail":"KorolevAA1@mos.ru","Дата регистрации":"17.04.2025 16:46:03","Последняя авторизация":"05.06.2026 16:13:58","ID":"691","Подразделения":"Группа технической поддержки"}
,
{"Логин":"LazarevRV","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Рафаэль","Фамилия":"Лазарев","Внешний код":"923e7c66-16a3-11f0-b082-00155d000912","E-Mail":"LazarevRV@mos.ru","Дата регистрации":"11.04.2025 16:34:03","Последняя авторизация":"10.08.2026 17:46:36","ID":"685","Подразделения":"Управление по работе со странами Азии"}
,
{"Логин":"GuzeninRO","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Руслан","Фамилия":"Гузенин","Внешний код":"724bcf07-0f92-11f0-b074-00155d000910","E-Mail":"GuzeninRO@mos.ru","Дата регистрации":"02.04.2025 16:16:02","Последняя авторизация":"05.08.2026 03:23:58","ID":"673","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"TekunovaNY","Активность":"Да","Дата изменения":"06.08.2026 05:36:17","Имя":"Наталия","Фамилия":"Текунова","Внешний код":"f61748aa-0ae2-11f0-b06e-00155d000912","E-Mail":"TekunovaNY@mos.ru","Дата регистрации":"02.04.2025 16:16:02","Последняя авторизация":"07.08.2026 16:27:38","ID":"675","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"user_671","Активность":"Да","Дата изменения":"11.08.2026 04:01:49","Имя":"Елизавета","Фамилия":"Тарасова","Внешний код":"04a2c285-0ae2-11f0-b06e-00155d000912","E-Mail":"SolodukhinaEA@mos.ru","Дата регистрации":"02.04.2025 04:10:12","Последняя авторизация":"22.06.2026 09:54:39","ID":"671","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"SemenovaAV","Активность":"Да","Дата изменения":"03.08.2026 17:31:11","Имя":"Анастасия","Фамилия":"Семёнова","Внешний код":"bb6449ba-0ed2-11f0-b073-00155d000910","E-Mail":"SemenovaAV36@mos.ru","Дата регистрации":"01.04.2025 16:14:04","Последняя авторизация":"04.08.2026 09:08:53","ID":"669","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"LunkovAV","Активность":"Да","Дата изменения":"29.07.2026 05:20:07","Имя":"Александр","Фамилия":"Луньков","Внешний код":"cbd82977-0ecc-11f0-b073-00155d000910","E-Mail":"LunkovAV1@mos.ru","Дата регистрации":"01.04.2025 16:14:03","Последняя авторизация":"","ID":"667","Подразделения":"Дирекция международных коммуникаций"}
,
{"Логин":"DolgikhER","Активность":"Да","Дата изменения":"05.08.2026 17:35:04","Имя":"Екатерина","Фамилия":"Долгих","Внешний код":"","E-Mail":"DolgikhER@mos.ru","Дата регистрации":"24.03.2025 15:56:05","Последняя авторизация":"11.08.2026 03:02:02","ID":"654","Подразделения":""}
,
{"Логин":"VorobevKS","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Константин","Фамилия":"Воробьев","Внешний код":"fc1b9c55-0492-11f0-b066-00155d000912","E-Mail":"VorobevKS@mos.ru","Дата регистрации":"18.03.2025 15:46:45","Последняя авторизация":"04.08.2026 12:57:59","ID":"646","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"StepanovaAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:11","Имя":"Анна","Фамилия":"Степанова","Внешний код":"27180a6b-03c5-11f0-b065-00155d000912","E-Mail":"StepanovaAA6@mos.ru","Дата регистрации":"18.03.2025 15:46:35","Последняя авторизация":"10.08.2026 09:10:50","ID":"645","Подразделения":"Группа по работе с Китаем и СНГ"}
,
{"Логин":"SelivannikovaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Анастасия","Фамилия":"Селиванникова","Внешний код":"4e05b4b1-ffdd-11ef-b060-00155d000912","E-Mail":"SelivannikovaAA@mos.ru","Дата регистрации":"13.03.2025 15:37:29","Последняя авторизация":"10.08.2026 15:26:32","ID":"633","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"SemenovaDA5","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Дарья","Фамилия":"Семенова","Внешний код":"780d7669-fd7a-11ef-b05d-00155d000912","E-Mail":"SemenovaDA5@mos.ru","Дата регистрации":"07.03.2025 15:26:28","Последняя авторизация":"10.08.2026 09:49:30","ID":"629","Подразделения":"Управление взаиморасчетов с контрагентами"}
,
{"Логин":"user_627","Активность":"Да","Дата изменения":"06.08.2026 04:02:36","Имя":"Юлия","Фамилия":"Ордина","Внешний код":"467963cc-d610-11ee-aee8-00155d000912","E-Mail":"OrdinaYI@mos.ru","Дата регистрации":"07.03.2025 04:06:53","Последняя авторизация":"","ID":"627","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KarmatskiyIA","Активность":"Да","Дата изменения":"06.08.2026 05:36:17","Имя":"Илья","Фамилия":"Кармацкий","Внешний код":"b524be47-fd78-11ef-b05d-00155d000912","E-Mail":"KarmatskiyIA@mos.ru","Дата регистрации":"05.03.2025 15:22:10","Последняя авторизация":"","ID":"625","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"LyubavinaEV","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Елена","Фамилия":"Любавина","Внешний код":"7ab02b22-f8cd-11ef-b057-00155d000912","E-Mail":"LyubavinaEV@mos.ru","Дата регистрации":"03.03.2025 15:18:16","Последняя авторизация":"03.08.2026 14:34:32","ID":"623","Подразделения":"Управление по развитию гостиничной инфраструктуры"}
,
{"Логин":"PetryakovaEN","Активность":"Да","Дата изменения":"11.08.2026 05:46:08","Имя":"Елена","Фамилия":"Петрякова","Внешний код":"c74b9f6a-f4d0-11ef-b052-00155d000910","E-Mail":"PetryakovaEN@mos.ru","Дата регистрации":"25.02.2025 15:08:22","Последняя авторизация":"10.08.2026 17:25:29","ID":"620","Подразделения":"Управление взаиморасчетов с контрагентами"}
,
{"Логин":"krotovdv2","Активность":"Да","Дата изменения":"16.06.2026 07:38:08","Имя":"Денис","Фамилия":"Кротов","Внешний код":"","E-Mail":"krotovdv2@mos.ru","Дата регистрации":"25.02.2025 14:56:28","Последняя авторизация":"18.08.2025 19:03:37","ID":"619","Подразделения":""}
,
{"Логин":"YagovkinaAI","Активность":"Да","Дата изменения":"06.08.2026 05:36:17","Имя":"Анастасия","Фамилия":"Яговкина","Внешний код":"65686247-f282-11ef-b04f-00155d000910","E-Mail":"YagovkinaAI@mos.ru","Дата регистрации":"20.02.2025 18:12:31","Последняя авторизация":"05.08.2026 10:25:01","ID":"617","Подразделения":"Правовое управление"}
,
{"Логин":"user_615","Активность":"Да","Дата изменения":"20.07.2026 04:01:22","Имя":"Вера","Фамилия":"Головченко","Внешний код":"740f99cc-1736-11ee-adf1-00155d000910","E-Mail":"GolovchenkoVV@mos.ru","Дата регистрации":"20.02.2025 10:36:41","Последняя авторизация":"20.07.2026 18:30:20","ID":"615","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"user_614","Активность":"Да","Дата изменения":"14.05.2025 10:20:00","Имя":"Мария","Фамилия":"Камендровская","Внешний код":"a3247f4d-c265-11ed-ad83-00155d000912","E-Mail":"mari.kamend@mail.ru","Дата регистрации":"20.02.2025 10:35:55","Последняя авторизация":"","ID":"614","Подразделения":""}
,
{"Логин":"BrezgunovOV","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Олег","Фамилия":"Брезгунов","Внешний код":"6a32ae9d-eea5-11ef-b04a-00155d000910","E-Mail":"BrezgunovOV@mos.ru","Дата регистрации":"18.02.2025 15:12:04","Последняя авторизация":"30.07.2026 08:44:23","ID":"608","Подразделения":"Группа технической поддержки"}
,
{"Логин":"ShatskiyMS","Активность":"Да","Дата изменения":"10.08.2026 17:45:09","Имя":"Максим","Фамилия":"Шатский","Внешний код":"326e087e-ee93-11ef-b04a-00155d000910","E-Mail":"ShatskiyMS1@mos.ru","Дата регистрации":"18.02.2025 15:12:04","Последняя авторизация":"05.08.2026 18:29:46","ID":"609","Подразделения":"Группа Web-разработки"}
,
{"Логин":"user_606","Активность":"Да","Дата изменения":"","Имя":"Заместитель","Фамилия":"Петров","Внешний код":"5a92e90a-e9ff-11ef-b048-00155d000912","E-Mail":"vkomar_606@korusconsulting.ru","Дата регистрации":"17.02.2025 10:27:38","Последняя авторизация":"","ID":"606","Подразделения":""}
,
{"Логин":"LukashenkoMA","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Михаил","Фамилия":"Лукашенко","Внешний код":"43ed845e-ecff-11ef-b048-00155d000912","E-Mail":"LukashenkoMA@mos.ru","Дата регистрации":"14.02.2025 03:03:02","Последняя авторизация":"05.08.2026 15:17:32","ID":"605","Подразделения":"Группа Web-разработки"}
,
{"Логин":"TikhonovTL","Активность":"Да","Дата изменения":"29.07.2026 17:21:05","Имя":"Тимофей","Фамилия":"Тихонов","Внешний код":"b4af3cf2-e791-11ef-b046-00155d000910","E-Mail":"TikhonovTL@mos.ru","Дата регистрации":"07.02.2025 14:24:44","Последняя авторизация":"13.07.2026 14:21:31","ID":"600","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"KutuzovaIA","Активность":"Да","Дата изменения":"05.08.2026 05:34:09","Имя":"Ирина","Фамилия":"Кутузова","Внешний код":"85ae946a-e77d-11ef-b046-00155d000910","E-Mail":"KutuzovaIA1@mos.ru","Дата регистрации":"07.02.2025 14:24:17","Последняя авторизация":"31.07.2026 10:30:36","ID":"599","Подразделения":"Группа тестировщиков"}
,
{"Логин":"AlsairafiEB","Активность":"Да","Дата изменения":"12.05.2025 17:33:02","Имя":"Елизавета","Фамилия":"Альсаирафи","Внешний код":"","E-Mail":"AlsairafiEB@mos.ru","Дата регистрации":"07.02.2025 14:24:03","Последняя авторизация":"14.04.2025 09:55:01","ID":"597","Подразделения":""}
,
{"Логин":"TikhonovAV","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Андрей","Фамилия":"Тихонов","Внешний код":"4160379d-639c-11f0-b0e5-00155d000912","E-Mail":"TikhonovAV7@mos.ru","Дата регистрации":"06.02.2025 22:22:32","Последняя авторизация":"10.08.2026 16:04:53","ID":"595","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"user_589","Активность":"Да","Дата изменения":"11.08.2026 04:01:48","Имя":"Артем","Фамилия":"Анашкин","Внешний код":"546347f9-9c0f-11ef-afe7-00155d000910","E-Mail":"AnashkinAI3@mos.ru","Дата регистрации":"06.02.2025 09:59:38","Последняя авторизация":"","ID":"589","Подразделения":"Группа тестировщиков"}
,
{"Логин":"user_590","Активность":"Да","Дата изменения":"15.06.2026 13:43:27","Имя":"Эмилия","Фамилия":"Абдрахманова","Внешний код":"87aee931-9c27-11ef-afe7-00155d000910","E-Mail":"AbdrakhmanovaER@mos.ru","Дата регистрации":"06.02.2025 09:59:38","Последняя авторизация":"","ID":"590","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_591","Активность":"Да","Дата изменения":"30.06.2025 11:03:22","Имя":"Илья","Фамилия":"Шевалдин","Внешний код":"1dc880e6-9cdd-11ef-afe8-00155d000910","E-Mail":"ShevaldinIV@mos.ru","Дата регистрации":"06.02.2025 09:59:38","Последняя авторизация":"","ID":"591","Подразделения":"Группа реализации"}
,
{"Логин":"user_588","Активность":"Да","Дата изменения":"05.08.2026 19:17:43","Имя":"Алексей","Фамилия":"Тимофеев","Внешний код":"8bf6ed13-9773-11ef-afe1-00155d000912","E-Mail":"alian.tim.job24@gmail.com","Дата регистрации":"06.02.2025 09:59:37","Последняя авторизация":"","ID":"588","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"VeltmanAV","Активность":"Да","Дата изменения":"14.07.2026 04:50:03","Имя":"Алексей","Фамилия":"Вельтман","Внешний код":"dbf6c15e-53d9-11ef-af8a-00155d000912","E-Mail":"VeltmanAV@mos.ru","Дата регистрации":"06.02.2025 09:58:54","Последняя авторизация":"","ID":"586","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"user_585","Активность":"Да","Дата изменения":"11.08.2026 04:01:46","Имя":"Екатерина","Фамилия":"Савва","Внешний код":"eca5cbbb-53d8-11ef-af8a-00155d000912","E-Mail":"larryisrealforever74@gmail.com","Дата регистрации":"06.02.2025 09:58:53","Последняя авторизация":"","ID":"585","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_583","Активность":"Да","Дата изменения":"24.07.2026 04:01:38","Имя":"Анна","Фамилия":"Токовая","Внешний код":"bc6dbda5-9d70-11ee-aea0-00155d000910","E-Mail":"anettok1324@gmail.com","Дата регистрации":"06.02.2025 09:56:20","Последняя авторизация":"13.07.2026 14:00:41","ID":"583","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_582","Активность":"Да","Дата изменения":"05.08.2026 19:16:17","Имя":"Анастасия","Фамилия":"Михайлова","Внешний код":"e90fc508-7e07-11ee-ae77-00155d000912","E-Mail":"mikhaylova.anastasia.2004@mail.ru","Дата регистрации":"06.02.2025 09:56:19","Последняя авторизация":"","ID":"582","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_581","Активность":"Да","Дата изменения":"24.07.2026 04:01:36","Имя":"Елена","Фамилия":"Вотякова","Внешний код":"80681355-7d32-11ee-ae76-00155d000910","E-Mail":"tokareva1007@gmail.com","Дата регистрации":"06.02.2025 09:56:18","Последняя авторизация":"","ID":"581","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"user_579","Активность":"Да","Дата изменения":"30.07.2026 04:01:28","Имя":"Дмитрий","Фамилия":"Бодров","Внешний код":"5175dca5-6347-11ee-ae55-00155d000910","E-Mail":"dima1997_70@mail.ru","Дата регистрации":"06.02.2025 09:55:30","Последняя авторизация":"","ID":"579","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_576","Активность":"Да","Дата изменения":"05.08.2026 19:18:28","Имя":"Павел","Фамилия":"Сафронов","Внешний код":"715008ee-306a-11ee-ae13-00155d000912","E-Mail":"darthspv@gmail.com","Дата регистрации":"06.02.2025 09:55:29","Последняя авторизация":"","ID":"576","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"user_577","Активность":"Да","Дата изменения":"25.05.2026 17:47:10","Имя":"Ирина","Фамилия":"Шванская","Внешний код":"a94fd772-3a7b-11ee-ae20-00155d000910","E-Mail":"irensky13@gmail.com","Дата регистрации":"06.02.2025 09:55:29","Последняя авторизация":"","ID":"577","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_574","Активность":"Да","Дата изменения":"22.07.2026 04:02:50","Имя":"Юлия","Фамилия":"Феоктистова","Внешний код":"a8dff842-198e-11ee-adf4-00155d000910","E-Mail":"july2708@mail.ru","Дата регистрации":"06.02.2025 09:55:28","Последняя авторизация":"","ID":"574","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_571","Активность":"Да","Дата изменения":"05.08.2026 19:16:15","Имя":"Маргарита","Фамилия":"Зайцева","Внешний код":"a54b37fb-0115-11ee-add3-00155d000912","E-Mail":"margosha7173@mail.ru","Дата регистрации":"06.02.2025 09:55:27","Последняя авторизация":"05.08.2026 10:23:48","ID":"571","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_573","Активность":"Да","Дата изменения":"30.07.2026 04:01:28","Имя":"Екатерина","Фамилия":"Райдер","Внешний код":"de0e52ef-1978-11ee-adf4-00155d000910","E-Mail":"krayder9@gmail.com","Дата регистрации":"06.02.2025 09:55:27","Последняя авторизация":"","ID":"573","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_570","Активность":"Да","Дата изменения":"15.06.2026 13:43:24","Имя":"Евгения","Фамилия":"Липс","Внешний код":"f5f9ce86-d840-11ed-ad9f-00155d000912","E-Mail":"LipsEG@it.mos.ru","Дата регистрации":"06.02.2025 09:55:26","Последняя авторизация":"","ID":"570","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_561","Активность":"Да","Дата изменения":"05.08.2026 19:16:12","Имя":"Ирина","Фамилия":"Кораблина","Внешний код":"d9b9428f-a15a-11ed-ad57-00155d000912","E-Mail":"KorablinaIA@mos.ru","Дата регистрации":"06.02.2025 09:54:37","Последняя авторизация":"04.08.2026 10:51:06","ID":"561","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"user_562","Активность":"Да","Дата изменения":"24.07.2026 04:01:33","Имя":"Ольга","Фамилия":"Федина","Внешний код":"3a844461-a200-11ed-ad58-00155d000910","E-Mail":"FedinaON@mos.ru","Дата регистрации":"06.02.2025 09:54:37","Последняя авторизация":"","ID":"562","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_563","Активность":"Да","Дата изменения":"06.07.2026 09:10:21","Имя":"Дмитрий","Фамилия":"Пароходов","Внешний код":"336db161-a202-11ed-ad58-00155d000910","E-Mail":"ParokhodovDY@mos.ru","Дата регистрации":"06.02.2025 09:54:37","Последняя авторизация":"","ID":"563","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_564","Активность":"Да","Дата изменения":"06.07.2026 09:10:21","Имя":"Георгий","Фамилия":"Ёлкин","Внешний код":"0dbe8b16-a20a-11ed-ad58-00155d000910","E-Mail":"ElkinGV@mos.ru","Дата регистрации":"06.02.2025 09:54:37","Последняя авторизация":"","ID":"564","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_565","Активность":"Да","Дата изменения":"10.07.2026 04:01:38","Имя":"Руслан","Фамилия":"Медников","Внешний код":"f1c3529a-a213-11ed-ad58-00155d000910","E-Mail":"MednikovRV@mos.ru","Дата регистрации":"06.02.2025 09:54:37","Последняя авторизация":"","ID":"565","Подразделения":"Группа технической поддержки"}
,
{"Логин":"user_560","Активность":"Да","Дата изменения":"06.08.2026 04:01:22","Имя":"Илья","Фамилия":"Нилов","Внешний код":"045ad09d-5ffe-11ed-acfc-00155d000910","E-Mail":"ilyanilov1987@gmail.com","Дата регистрации":"06.02.2025 09:54:35","Последняя авторизация":"","ID":"560","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_559","Активность":"Да","Дата изменения":"29.07.2026 04:01:37","Имя":"Заррина","Фамилия":"Садыкова","Внешний код":"1ac68c93-3984-11ed-accb-00155d000910","E-Mail":"zayatut@bk.ru","Дата регистрации":"06.02.2025 09:53:46","Последняя авторизация":"05.08.2026 10:25:22","ID":"559","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_556","Активность":"Да","Дата изменения":"29.07.2026 04:01:36","Имя":"Артем","Фамилия":"Казанцев","Внешний код":"e95f3040-e56f-11ec-ac5c-00155d000912","E-Mail":"KazantsevAE@mos.ru","Дата регистрации":"06.02.2025 09:53:44","Последняя авторизация":"27.07.2026 16:09:05","ID":"556","Подразделения":"Управление развития"}
,
{"Логин":"user_557","Активность":"Да","Дата изменения":"27.01.2026 04:02:44","Имя":"Евгения","Фамилия":"Ахмедзянова","Внешний код":"1864ca57-0e4d-11ed-ac92-00155d000910","E-Mail":"Evgeshaah@gmail.com","Дата регистрации":"06.02.2025 09:53:44","Последняя авторизация":"","ID":"557","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"user_553","Активность":"Да","Дата изменения":"05.08.2026 19:16:08","Имя":"Галина","Фамилия":"Стрелкова","Внешний код":"7b4313b4-5f30-11ec-ab9d-00155d051a08","E-Mail":"g_strelkova@mail.ru","Дата регистрации":"06.02.2025 09:52:53","Последняя авторизация":"","ID":"553","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_554","Активность":"Да","Дата изменения":"11.08.2026 04:01:39","Имя":"Юрий","Фамилия":"Львов","Внешний код":"19336669-68ad-11ec-abaa-00155d051a08","E-Mail":"lvoff42@gmail.com","Дата регистрации":"06.02.2025 09:52:53","Последняя авторизация":"","ID":"554","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"user_548","Активность":"Да","Дата изменения":"30.04.2026 10:26:46","Имя":"Екатерина","Фамилия":"Скакун","Внешний код":"190f65b7-a683-11eb-aab3-00155d1a381f","E-Mail":"KochetkovaEA4@mos.ru","Дата регистрации":"06.02.2025 09:52:49","Последняя авторизация":"","ID":"548","Подразделения":""}
,
{"Логин":"user_546","Активность":"Да","Дата изменения":"06.08.2026 04:01:17","Имя":"Екатерина","Фамилия":"Айрапетян","Внешний код":"c4bb5573-5fa4-11eb-aa59-00155d1a381f","E-Mail":"KarapetyanEI@mos.ru","Дата регистрации":"06.02.2025 09:52:48","Последняя авторизация":"","ID":"546","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"user_544","Активность":"Да","Дата изменения":"06.08.2026 04:01:16","Имя":"Юлия","Фамилия":"Бриккман","Внешний код":"0ac88f7d-4515-11eb-aa35-00155d1a381f","E-Mail":"DimitryukYI@mos.ru","Дата регистрации":"06.02.2025 09:51:55","Последняя авторизация":"","ID":"544","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"ShigaevRK@mos.ru","Активность":"Да","Дата изменения":"06.07.2026 09:08:52","Имя":"Ринат","Фамилия":"Шигаев","Внешний код":"8ff4e4ca-22ea-11e9-a98f-00155d1a3433","E-Mail":"ShigaevRK@mos.ru","Дата регистрации":"06.02.2025 09:51:51","Последняя авторизация":"20.07.2026 17:31:09","ID":"541","Подразделения":"Управление развития"}
,
{"Логин":"ShevchenkoAI","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Анна","Фамилия":"Шевченко","Внешний код":"f61e580e-dc7a-11ef-b03a-00155d000912","E-Mail":"ShevchenkoAI2@mos.ru","Дата регистрации":"03.02.2025 17:56:49","Последняя авторизация":"10.08.2026 08:55:34","ID":"532","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KolesnikovaAA","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Анна","Фамилия":"Колесникова","Внешний код":"77151f75-e2c4-11ef-b042-00155d000912","E-Mail":"KolesnikovaAA3@mos.ru","Дата регистрации":"03.02.2025 17:56:49","Последняя авторизация":"10.08.2026 09:08:20","ID":"534","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"ManafovaFR","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Фидан","Фамилия":"Манафова","Внешний код":"1837d110-e205-11ef-b041-00155d000910","E-Mail":"ManafovaFR@mos.ru","Дата регистрации":"03.02.2025 17:56:49","Последняя авторизация":"07.08.2026 09:52:22","ID":"536","Подразделения":"Управление аналитического сопровождения деятельности"}
,
{"Логин":"SokolovRO","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Роман","Фамилия":"Соколов","Внешний код":"9e3f9a7b-dfbf-11ef-b03e-00155d000912","E-Mail":"SokolovRO@mos.ru","Дата регистрации":"03.02.2025 17:56:49","Последняя авторизация":"06.08.2026 14:22:37","ID":"537","Подразделения":"Группа реализации"}
,
{"Логин":"EfimovAI","Активность":"Да","Дата изменения":"28.07.2026 17:19:04","Имя":"Александр","Фамилия":"Ефимов","Внешний код":"350b9d2d-b088-11ef-b001-00155d000910","E-Mail":"EfimovAI3@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"06.08.2026 16:19:50","ID":"508","Подразделения":"Группа реализации"}
,
{"Логин":"NiyazovNS","Активность":"Да","Дата изменения":"28.11.2025 11:56:04","Имя":"Назарбек","Фамилия":"Ниязов","Внешний код":"","E-Mail":"NiyazovNS@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"","ID":"509","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"SolovyanovAA","Активность":"Да","Дата изменения":"31.07.2026 17:25:04","Имя":"Алексей","Фамилия":"Соловьянов","Внешний код":"43fd6d2e-b2d8-11ef-b004-00155d000910","E-Mail":"SolovyanovAA@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"30.07.2026 09:00:42","ID":"510","Подразделения":"Группа тестировщиков"}
,
{"Логин":"FisunovaOD","Активность":"Да","Дата изменения":"03.08.2026 17:31:10","Имя":"Ольга","Фамилия":"Фисунова","Внешний код":"91a1bf67-b933-11ef-b00c-00155d000912","E-Mail":"FisunovaOD@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"30.07.2026 13:33:16","ID":"512","Подразделения":"Управление по развитию гостиничной инфраструктуры"}
,
{"Логин":"DochviriIA","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Ираклий","Фамилия":"Дочвири","Внешний код":"25c629c2-b146-11ef-b002-00155d000912","E-Mail":"DochviriIA@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"05.08.2026 09:41:59","ID":"514","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"NikitchenkoIA","Активность":"Да","Дата изменения":"04.08.2026 05:32:06","Имя":"Илья","Фамилия":"Никитченко","Внешний код":"3b28b49b-68f8-11ef-afa5-00155d000910","E-Mail":"NikitchenkoIA@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"03.08.2026 16:46:25","ID":"521","Подразделения":"Управление по развитию гостиничной инфраструктуры"}
,
{"Логин":"KryuchkovaVA","Активность":"Да","Дата изменения":"29.07.2026 05:20:07","Имя":"Варвара","Фамилия":"Крючкова","Внешний код":"6bc25b8b-d17b-11ef-b02b-00155d000910","E-Mail":"KryuchkovaVA3@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"30.07.2026 09:19:39","ID":"523","Подразделения":"Управление онлайн-маркетинга"}
,
{"Логин":"AfanasevaDI","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Дарья","Фамилия":"Афанасьева","Внешний код":"d2db1e3e-d18f-11ef-b02b-00155d000910","E-Mail":"AfanasevaDI@mos.ru","Дата регистрации":"03.02.2025 17:56:48","Последняя авторизация":"10.08.2026 10:21:19","ID":"525","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"GroshevaAV","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Анастасия","Фамилия":"Грошева","Внешний код":"","E-Mail":"GroshevaA3@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"07.08.2026 10:24:56","ID":"485","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"BulgakovaAI","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Анна","Фамилия":"Булгакова","Внешний код":"e2a5da8c-d2b0-11ed-ad98-00155d000910","E-Mail":"BulgakovaAI@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"28.07.2026 09:49:36","ID":"491","Подразделения":"Дирекция интегрированных коммуникаций"}
,
{"Логин":"ErbolatovaAU","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Амина","Фамилия":"Эрболатова","Внешний код":"25c1d10d-b384-11ee-aebc-00155d000912","E-Mail":"ErbolatovaAU@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"22.07.2026 15:37:01","ID":"492","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"BoroveevaTS","Активность":"Да","Дата изменения":"09.08.2026 17:43:03","Имя":"Татьяна","Фамилия":"Боровеева","Внешний код":"d1720e10-3415-11e9-a98f-00155d1a3433","E-Mail":"BoroveevaTS@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"10.08.2026 16:06:24","ID":"493","Подразделения":"Дирекция по взаимодействию с органами власти"}
,
{"Логин":"GerasimovDA","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Даниил","Фамилия":"Герасимов","Внешний код":"f0b218a6-2c73-11ef-af58-00155d000910","E-Mail":"gerasimovda2@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"10.08.2026 13:04:28","ID":"495","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"ArzhanovaAD","Активность":"Да","Дата изменения":"30.07.2026 17:23:07","Имя":"Анастасия","Фамилия":"Аржанова","Внешний код":"d224554d-2838-11f1-b1e3-00155d000912","E-Mail":"ArzhanovaAD@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"30.07.2026 21:59:44","ID":"496","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"KnyazevAD","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Андрей","Фамилия":"Князев","Внешний код":"7f93f20d-e107-11ee-aef8-00155d000910","E-Mail":"KnyazevAD3@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"07.08.2026 09:09:28","ID":"498","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"LarinaVN","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Валерия","Фамилия":"Ларина","Внешний код":"a0438c9a-d470-11ee-aee6-00155d000912","E-Mail":"LarinaVN@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"06.08.2026 11:45:19","ID":"499","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"PlotnikovaAS1","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Алёна","Фамилия":"Плотникова","Внешний код":"39a4d764-aefe-11ee-aeb6-00155d000912","E-Mail":"PlotnikovaAS1@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"06.08.2026 18:47:28","ID":"500","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"KolokoltsevSD","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Сергей","Фамилия":"Колокольцев","Внешний код":"efc7280b-1287-11ef-af37-00155d000910","E-Mail":"KolokoltsevSD@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"11.08.2026 08:44:44","ID":"501","Подразделения":"Управление по развитию коммерческих продуктов"}
,
{"Логин":"KovalevNA","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Никита","Фамилия":"Ковалев","Внешний код":"fd2367a4-a1fe-11ed-ad58-00155d000910","E-Mail":"KovalevNA@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"10.08.2026 09:58:43","ID":"503","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"ZubkovaNV","Активность":"Да","Дата изменения":"10.06.2026 03:42:08","Имя":"Наталья","Фамилия":"Зубкова","Внешний код":"","E-Mail":"ZubkovaNV1@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"","ID":"504","Подразделения":""}
,
{"Логин":"kaluginia","Активность":"Да","Дата изменения":"03.08.2026 17:31:10","Имя":"Иван","Фамилия":"Калугин","Внешний код":"12014990-b07b-11ef-b001-00155d000910","E-Mail":"KaluginIA@mos.ru","Дата регистрации":"03.02.2025 17:56:47","Последняя авторизация":"11.08.2026 04:55:10","ID":"507","Подразделения":"Группа системного администрирования"}
,
{"Логин":"AzarovaAY","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Анастасия","Фамилия":"Азарова","Внешний код":"e6650b10-53be-11ef-af8a-00155d000912","E-Mail":"AzarovaAY1@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"11.08.2026 00:46:58","ID":"464","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"StepanenkoDR","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Дмитрий","Фамилия":"Степаненко","Внешний код":"0f659660-2535-11ee-ae05-00155d000912","E-Mail":"StepanenkoDR@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 15:48:02","ID":"466","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"balandyuk","Активность":"Да","Дата изменения":"06.08.2026 17:37:06","Имя":"Максим","Фамилия":"Баландюк","Внешний код":"58f41ef5-47f5-11ef-af7b-00155d000910","E-Mail":"BalandyukMI@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"06.08.2026 11:09:15","ID":"467","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"ArtamoshkinaNV","Активность":"Да","Дата изменения":"03.08.2026 17:31:10","Имя":"Наталья","Фамилия":"Артамошкина","Внешний код":"133032c5-66c1-11ef-afa2-00155d000912","E-Mail":"artamoshkinanv@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 12:15:31","ID":"468","Подразделения":"Группа технической поддержки"}
,
{"Логин":"SorokinaAV","Активность":"Да","Дата изменения":"04.08.2026 05:32:05","Имя":"Анна","Фамилия":"Гришина","Внешний код":"6a65204d-d0b4-11ee-aee1-00155d000910","E-Mail":"SorokinaAV9@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 09:01:44","ID":"469","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"MakovetskayaSV","Активность":"Да","Дата изменения":"03.08.2026 17:31:10","Имя":"Софья","Фамилия":"Маковецкая","Внешний код":"6b284577-0b25-11ec-ab32-00155d051a08","E-Mail":"makovetskayasv@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 09:01:53","ID":"470","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"VertunovaDD","Активность":"Да","Дата изменения":"03.08.2026 17:31:10","Имя":"Дарья","Фамилия":"Вертунова","Внешний код":"f14c2c60-5419-11eb-aa48-00155d1a381f","E-Mail":"vertunovadd@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"07.08.2026 14:52:18","ID":"472","Подразделения":"Административное управление"}
,
{"Логин":"PodlegaevGolovinAD","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Александр","Фамилия":"Подлегаев-Головин","Внешний код":"35cfcf07-fb01-11ee-af19-00155d000912","E-Mail":"PodlegaevGolovinAD@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 17:24:14","ID":"473","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"PervushinaNS","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Надежда","Фамилия":"Первушина","Внешний код":"5a40701c-5551-11ef-af8c-00155d000912","E-Mail":"PervushinaNS@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"04.08.2026 14:28:07","ID":"474","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"ZaikovaKV","Активность":"Да","Дата изменения":"10.08.2026 17:45:08","Имя":"Ксения","Фамилия":"Зайкова","Внешний код":"1725ba17-d44c-11ed-ad9a-00155d000910","E-Mail":"ZaikovaKV@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 09:15:57","ID":"475","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"KomissarovaAA","Активность":"Да","Дата изменения":"30.07.2026 17:23:07","Имя":"Анастасия","Фамилия":"Комиссарова","Внешний код":"7458f3cc-eff4-11ee-af0b-00155d000912","E-Mail":"KomissarovaAA5@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"31.07.2026 14:10:50","ID":"476","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"VoskanyantsNE","Активность":"Да","Дата изменения":"29.07.2026 05:20:06","Имя":"Наталья","Фамилия":"Восканянц","Внешний код":"56f3a59f-2ce5-11f1-b1e9-00155d000910","E-Mail":"VoskanyantsNE@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"16.06.2026 12:38:11","ID":"477","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"KurshevNV","Активность":"Да","Дата изменения":"27.07.2026 17:17:07","Имя":"Никита","Фамилия":"Куршев","Внешний код":"a509107e-12fa-11ed-ac98-00155d000912","E-Mail":"KurshevNV@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"14.07.2026 16:04:52","ID":"479","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"YakovlevaMI","Активность":"Да","Дата изменения":"30.07.2026 17:23:07","Имя":"Мария","Фамилия":"Яковлева","Внешний код":"0e1e1976-2831-11f1-b1e3-00155d000912","E-Mail":"YakovlevaMI1@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"30.07.2026 15:12:44","ID":"480","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"MedvedevaIA","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Ирина","Фамилия":"Медведева","Внешний код":"","E-Mail":"MedvedevaIA6@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"10.08.2026 09:24:09","ID":"482","Подразделения":""}
,
{"Логин":"KonyaevaKS","Активность":"Да","Дата изменения":"23.07.2026 05:08:08","Имя":"Ксения","Фамилия":"Коняева","Внешний код":"7524c1fe-283b-11f1-b1e3-00155d000912","E-Mail":"KonyaevaKS@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"22.07.2026 17:44:58","ID":"483","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"ShirshovaVA","Активность":"Да","Дата изменения":"09.06.2026 15:40:47","Имя":"Варвара","Фамилия":"Ширшова","Внешний код":"d3dba922-3182-11ec-ab63-00155d051a08","E-Mail":"ShirshovaVA@mos.ru","Дата регистрации":"03.02.2025 17:56:46","Последняя авторизация":"","ID":"484","Подразделения":"Управление развития кадрового потенциала отрасли"}
,
{"Логин":"PetrovaEV","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Елена","Фамилия":"Петрова","Внешний код":"cfce59ee-28cd-11eb-aa10-00155d1a381f","E-Mail":"petrovaev9@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"31.07.2026 14:24:01","ID":"440","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"LozovskayaSF","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Светлана","Фамилия":"Лозовская","Внешний код":"f4c600bc-f0be-11ee-af0c-00155d000912","E-Mail":"LozovskayaSF@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 14:14:11","ID":"441","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"YandrovaMA","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Мария","Фамилия":"Яндрова","Внешний код":"d3596a91-bfe8-11e9-a994-00155d1a3432","E-Mail":"YandrovaMA@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 11:13:54","ID":"442","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"RyabovaNL","Активность":"Да","Дата изменения":"30.07.2026 05:22:04","Имя":"Наталья","Фамилия":"Рябова","Внешний код":"75f87875-2d24-11f1-b1e9-00155d000910","E-Mail":"RyabovaNL@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"29.07.2026 18:10:52","ID":"445","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"LesyukGA","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Георгий","Фамилия":"Лесюк","Внешний код":"e575af0a-e4f1-11ee-aefd-00155d000912","E-Mail":"LesyukGA@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"07.08.2026 12:26:23","ID":"446","Подразделения":"Группа по подбору персонала"}
,
{"Логин":"BelikSS","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Сергей","Фамилия":"Белик","Внешний код":"503f1a8f-b3e2-11ec-ac0a-00155d051a08","E-Mail":"belikss@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 09:51:11","ID":"447","Подразделения":"Дирекция аналитики и исследований"}
,
{"Логин":"TrishinaLA","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Людмила","Фамилия":"Тришина","Внешний код":"de9ffcaf-0878-11ef-af2a-00155d000912","E-Mail":"TrishinaLA@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"07.08.2026 09:29:41","ID":"451","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"PenkovIA","Активность":"Да","Дата изменения":"18.06.2026 15:58:06","Имя":"Игорь","Фамилия":"Пеньков","Внешний код":"","E-Mail":"penkovia@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"04.05.2026 12:53:29","ID":"452","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"KononovaED","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Елизавета","Фамилия":"Кононова","Внешний код":"43f0e408-2f41-11ed-acbe-00155d000912","E-Mail":"kononovaed@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 16:19:56","ID":"453","Подразделения":"Правовое управление"}
,
{"Логин":"KosachTG","Активность":"Да","Дата изменения":"07.08.2026 17:39:04","Имя":"Татьяна","Фамилия":"Аншакова","Внешний код":"","E-Mail":"KosachTG@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 17:20:16","ID":"454","Подразделения":"Правовое управление"}
,
{"Логин":"MarusovDA","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Дмитрий","Фамилия":"Марусов","Внешний код":"67aa2016-b171-11ea-a9b7-00155d1a2829","E-Mail":"MarusovDA@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"11.08.2026 02:59:35","ID":"455","Подразделения":"Правовое управление"}
,
{"Логин":"MilyantsevichMA","Активность":"Да","Дата изменения":"11.08.2026 05:46:05","Имя":"Марина","Фамилия":"Милянцевич","Внешний код":"15e45182-68f6-11ef-afa5-00155d000910","E-Mail":"MilyantsevichMA@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 16:48:45","ID":"457","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"MonastyrskiyES","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Евгений","Фамилия":"Монастырский","Внешний код":"113cb516-db42-11ec-ac4d-00155d000912","E-Mail":"MonastyrskiyES@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"04.08.2026 08:37:59","ID":"459","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"MatveevaIA","Активность":"Да","Дата изменения":"31.07.2026 17:25:03","Имя":"Инна","Фамилия":"Матвеева","Внешний код":"7e84820e-2842-11f1-b1e3-00155d000912","E-Mail":"MatveevaIA3@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"31.07.2026 13:34:13","ID":"460","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"DemidovaEA","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Евгения","Фамилия":"Демидова","Внешний код":"30bb9a88-2839-11f1-b1e3-00155d000912","E-Mail":"demidovaea3@mos.ru","Дата регистрации":"03.02.2025 17:56:45","Последняя авторизация":"10.08.2026 10:02:56","ID":"461","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"BisyarinaOA","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Ольга","Фамилия":"Бисярина","Внешний код":"877d95e6-ec7a-11ec-ac65-00155d000912","E-Mail":"BisyarinaOA@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 09:46:05","ID":"418","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"SergeevaAV","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Анна","Фамилия":"Сергеева","Внешний код":"40c3a5ef-ea12-11f0-b193-00155d000910","E-Mail":"SergeevaAV17@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 17:25:11","ID":"421","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"DemidikOA","Активность":"Да","Дата изменения":"03.08.2026 17:31:09","Имя":"Ольга","Фамилия":"Демидик","Внешний код":"3fc89bc4-851c-11ee-ae80-00155d000912","E-Mail":"DemidikOA@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 09:13:40","ID":"422","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"KrivchanskayaEM","Активность":"Да","Дата изменения":"03.08.2026 17:31:09","Имя":"Екатерина","Фамилия":"Кривчанская","Внешний код":"ae226e0d-6374-11ef-af9e-00155d000912","E-Mail":"KrivchanskayaEM@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 14:19:11","ID":"423","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"nefedovai","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Александр","Фамилия":"Нефедов","Внешний код":"9f54ad7f-c5f3-11ec-ac21-00155d051a08","E-Mail":"nefedovai@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 10:14:33","ID":"424","Подразделения":"Сметно-договорное управление"}
,
{"Логин":"BaranivskayaNV","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Наталья","Фамилия":"Баранивская","Внешний код":"b69d4aeb-23d1-11ef-af4d-00155d000912","E-Mail":"BaranivskayaNV@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 09:34:57","ID":"425","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"VavilenkovaIL","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Ирина","Фамилия":"Вавиленкова","Внешний код":"f431b373-e8b7-11ed-adb4-00155d000912","E-Mail":"VavilenkovaIL1@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 09:06:19","ID":"426","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"kolomarea","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Елена","Фамилия":"Коломарь","Внешний код":"4bb6f055-29c3-11ed-acb6-00155d000912","E-Mail":"kolomarea@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 11:48:17","ID":"427","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"FonAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Анна","Фамилия":"Фон","Внешний код":"ff748d83-4407-11ef-af76-00155d000912","E-Mail":"FonAA@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 16:59:07","ID":"428","Подразделения":"Сметно-договорное управление"}
,
{"Логин":"ZagranichnyyDP","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Дмитрий","Фамилия":"Заграничный","Внешний код":"1935f0ce-47f7-11ef-af7b-00155d000910","E-Mail":"ZagranichnyyDP@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"06.08.2026 12:45:10","ID":"431","Подразделения":"Управление по развитию образовательного и детского туризма"}
,
{"Логин":"ShornikovaES","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Екатерина","Фамилия":"Шорникова","Внешний код":"f8d4f9b5-4c0b-11ea-a99f-00155d1a38ec","E-Mail":"ShornikovaES@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"10.08.2026 10:39:21","ID":"432","Подразделения":"Управление по развитию образовательного и детского туризма"}
,
{"Логин":"LisovskayaEM","Активность":"Да","Дата изменения":"29.07.2026 05:20:05","Имя":"Екатерина","Фамилия":"Лисовская","Внешний код":"858bdab5-1846-11eb-a9fb-00155d1a381f","E-Mail":"lisovskayaem@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"24.07.2026 12:54:16","ID":"434","Подразделения":"Управление нормативно-правового регулирования и законодательных инициатив"}
,
{"Логин":"PodeyOI","Активность":"Да","Дата изменения":"06.08.2026 05:36:13","Имя":"Ольга","Фамилия":"Подей","Внешний код":"ba3a959f-9c04-11ea-a9aa-00155d1a230c","E-Mail":"PodejOI@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"07.08.2026 08:53:40","ID":"436","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"VlasovaTY","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Татьяна","Фамилия":"Власова","Внешний код":"d1ace1ee-cbf3-11ee-aedb-00155d000912","E-Mail":"vlasovaty3@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"11.08.2026 08:59:09","ID":"437","Подразделения":"Расчетно-кассовая группа"}
,
{"Логин":"TychkoLV","Активность":"Да","Дата изменения":"10.08.2026 17:45:07","Имя":"Лариса","Фамилия":"Тычко","Внешний код":"8ac31542-c02b-11ea-a9c0-00155d1a381f","E-Mail":"tychkolv@mos.ru","Дата регистрации":"03.02.2025 17:56:44","Последняя авторизация":"06.08.2026 09:34:17","ID":"439","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"KlishinaVP","Активность":"Да","Дата изменения":"05.08.2026 17:35:04","Имя":"Виктория","Фамилия":"Клишина","Внешний код":"9d3ff22d-0919-11ef-af2b-00155d000910","E-Mail":"KlishinaVP@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"10.08.2026 10:12:45","ID":"396","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"KorenkovaAA","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Анастасия","Фамилия":"Коренькова","Внешний код":"f6cff9d1-428e-11ef-af74-00155d000912","E-Mail":"KorenkovaAA@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"07.08.2026 14:29:42","ID":"397","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"KlushinaEV","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Елена","Фамилия":"Клушина","Внешний код":"afd0e5ab-76fb-11ee-ae6e-00155d000912","E-Mail":"klushinaev2@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"10.08.2026 09:20:17","ID":"399","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"KurmaevaVY","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Валерия","Фамилия":"Курмаева","Внешний код":"f2d0e43e-4c87-11ee-ae38-00155d000910","E-Mail":"KurmaevaVY@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"04.08.2026 12:10:32","ID":"400","Подразделения":"Группа гастропроектов"}
,
{"Логин":"VlasovaEA","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Елена","Фамилия":"Власова","Внешний код":"87739100-bc48-11ea-a9be-00155d1a381f","E-Mail":"vlasovaea2@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"10.08.2026 18:28:45","ID":"402","Подразделения":"Управление реализации специальных проектов"}
,
{"Логин":"BurmistrovaYM","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Юлия","Фамилия":"Бурмистрова","Внешний код":"21dcddc1-2769-11ed-acb3-00155d000912","E-Mail":"burmistrovaym@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"10.08.2026 08:59:35","ID":"404","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"RudakovaDK","Активность":"Да","Дата изменения":"07.08.2026 05:38:03","Имя":"Дарья","Фамилия":"Рудакова","Внешний код":"bc615e79-7e13-11ee-ae77-00155d000912","E-Mail":"RudakovaDK@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"04.08.2026 13:05:15","ID":"405","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"KokorevaIA","Активность":"Да","Дата изменения":"05.08.2026 05:34:07","Имя":"Ирина","Фамилия":"Кокорева","Внешний код":"516e3782-5fb7-11eb-aa59-00155d1a381f","E-Mail":"kokorevaia1@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"22.07.2026 20:58:06","ID":"406","Подразделения":"Дирекция по специальным проектам"}
,
{"Логин":"KleymenovaMY","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Мария","Фамилия":"Платонова","Внешний код":"7c5e94dc-06be-11e9-a98f-00155d1a3433","E-Mail":"KleymenovaMY@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"03.08.2026 17:49:31","ID":"408","Подразделения":"Группа гастропроектов"}
,
{"Логин":"LaninGA","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Герман","Фамилия":"Ланин","Внешний код":"c89ff32c-73e3-11ea-a9a7-00155d1a230c","E-Mail":"laninga@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"07.08.2026 09:16:50","ID":"409","Подразделения":"Проектная группа"}
,
{"Логин":"MaksimovaOV","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Ольга","Фамилия":"Максимова","Внешний код":"b9270628-d4e3-11ec-ac43-00155d000910","E-Mail":"MaksimovaOV9@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"07.08.2026 16:15:51","ID":"410","Подразделения":"Дирекция по созданию туристско-информационной среды"}
,
{"Логин":"mashoshineg","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Евгений","Фамилия":"Машошин","Внешний код":"522b0c61-429c-11ef-af74-00155d000912","E-Mail":"MashoshinEG@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"10.08.2026 09:07:16","ID":"412","Подразделения":"Проектная группа"}
,
{"Логин":"SedovaAG","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Александра","Фамилия":"Седова","Внешний код":"5cd95fd7-cec4-11f0-b170-00155d000912","E-Mail":"SedovaAG@mos.ru","Дата регистрации":"03.02.2025 17:56:43","Последняя авторизация":"","ID":"415","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"BoyarskiiAA","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Андрей","Фамилия":"Боярский","Внешний код":"e8073dad-b7ff-11ed-ad76-00155d000912","E-Mail":"BoyarskiiAA@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 09:05:57","ID":"374","Подразделения":"Управление исследовательских проектов"}
,
{"Логин":"TovkachMN","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Максим","Фамилия":"Товкач","Внешний код":"31d29a21-69e5-11eb-aa66-00155d1a381f","E-Mail":"tovkachmn@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 17:56:39","ID":"375","Подразделения":"Управление аналитического сопровождения деятельности"}
,
{"Логин":"PogorelovSE","Активность":"Да","Дата изменения":"06.08.2026 05:36:11","Имя":"Сергей","Фамилия":"Погорелов","Внешний код":"954420c9-48c7-11ef-af7c-00155d000912","E-Mail":"pogorelovse1@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"24.07.2026 10:45:52","ID":"377","Подразделения":"Группа тестировщиков"}
,
{"Логин":"SaulyakKA","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Кирилл","Фамилия":"Сауляк","Внешний код":"e038d315-e567-11ec-ac5c-00155d000912","E-Mail":"saulyakka@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"07.08.2026 09:27:48","ID":"378","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KrasnovFE","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Филипп","Фамилия":"Краснов","Внешний код":"b12396be-5dff-11ef-af97-00155d000912","E-Mail":"krasnovfe@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"07.08.2026 15:23:32","ID":"380","Подразделения":"Группа системных инженеров"}
,
{"Логин":"SolodovaVR","Активность":"Да","Дата изменения":"06.08.2026 05:36:11","Имя":"Виктория","Фамилия":"Солодова","Внешний код":"3c39da64-5876-11ef-af90-00155d000912","E-Mail":"SolodovaVR@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 14:15:57","ID":"381","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"IzotkinAG","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Александр","Фамилия":"Изоткин","Внешний код":"46564cc6-1129-11f0-b076-00155d000912","E-Mail":"izotkinag@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 10:13:57","ID":"383","Подразделения":"Группа системных инженеров"}
,
{"Логин":"AnisimovaEV","Активность":"Да","Дата изменения":"30.07.2026 17:23:05","Имя":"Елена","Фамилия":"Анисимова","Внешний код":"160483e8-4909-11eb-aa3a-00155d1a381f","E-Mail":"AnisimovaEV1@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 09:44:12","ID":"384","Подразделения":"Управление взаиморасчетов с контрагентами"}
,
{"Логин":"MalyshevaDG","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Дарья","Фамилия":"Малышева","Внешний код":"6a0877b4-4f5e-11ef-af84-00155d000910","E-Mail":"MalyshevaDG@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 16:00:50","ID":"385","Подразделения":"Управление исследовательских проектов"}
,
{"Логин":"SamigullinaEF","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Эльвира","Фамилия":"Самигуллина","Внешний код":"a1202dc4-2e7f-11ed-acbd-00155d000910","E-Mail":"samigullinaef@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"04.08.2026 19:40:41","ID":"387","Подразделения":"Управление проектирования интерфейсов"}
,
{"Логин":"IvanovaAO","Активность":"Да","Дата изменения":"10.08.2026 17:45:06","Имя":"Анастасия","Фамилия":"Березнева","Внешний код":"9a11159a-b80b-11ed-ad76-00155d000912","E-Mail":"BereznevaAO@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"10.08.2026 16:56:05","ID":"390","Подразделения":"Управление развития кадрового потенциала отрасли"}
,
{"Логин":"MescheryakovaNI","Активность":"Да","Дата изменения":"15.06.2026 15:53:14","Имя":"Наталия","Фамилия":"Мещерякова","Внешний код":"4ee0318a-2838-11f1-b1e3-00155d000912","E-Mail":"MescheryakovaNI2@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"27.03.2026 09:57:41","ID":"391","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"SeleznevaEA","Активность":"Да","Дата изменения":"01.08.2026 17:27:03","Имя":"Елена","Фамилия":"Селезнева","Внешний код":"62ea6a17-283f-11f1-b1e3-00155d000912","E-Mail":"SeleznevaEA2@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"01.08.2026 12:07:59","ID":"392","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"BorisovDS","Активность":"Да","Дата изменения":"06.08.2026 05:36:12","Имя":"Денис","Фамилия":"Борисов","Внешний код":"d1720e2d-3415-11e9-a98f-00155d1a3433","E-Mail":"borisovds1@mos.ru","Дата регистрации":"03.02.2025 17:56:42","Последняя авторизация":"07.08.2026 09:40:19","ID":"393","Подразделения":"Управление административно-хозяйственного обеспечения"}
,
{"Логин":"TrufanovSA","Активность":"Да","Дата изменения":"06.08.2026 05:36:10","Имя":"Сергей","Фамилия":"Труфанов","Внешний код":"62c29c5f-52f2-11ef-af89-00155d000910","E-Mail":"trufanovsa@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"07.08.2026 09:45:59","ID":"352","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"NastasyukEV","Активность":"Да","Дата изменения":"06.08.2026 05:36:10","Имя":"Евгений","Фамилия":"Настасюк","Внешний код":"ae018724-0411-11ec-ab29-00155d051a08","E-Mail":"nastasyukev@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"10.08.2026 11:53:12","ID":"353","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"SidorovAY","Активность":"Да","Дата изменения":"15.07.2026 04:52:06","Имя":"Алексей","Фамилия":"Сидоров","Внешний код":"8cb63d19-4a6b-11ef-af7e-00155d000912","E-Mail":"SidorovAY4@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"05.05.2026 16:10:07","ID":"354","Подразделения":"Группа системных инженеров"}
,
{"Логин":"GordienkoAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Андрей","Фамилия":"Гордиенко","Внешний код":"e9c63013-7ef9-11ef-afc2-00155d000910","E-Mail":"gordienkoaa4@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"31.07.2026 09:33:09","ID":"355","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"YusipovRT","Активность":"Да","Дата изменения":"27.07.2026 05:16:03","Имя":"Руслан","Фамилия":"Юсипов","Внешний код":"c97e820a-424f-11ee-ae2b-00155d000910","E-Mail":"yusipovrt@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"23.07.2026 14:21:43","ID":"357","Подразделения":"Архитектор проекта"}
,
{"Логин":"SpetsakovaVE","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Виктория","Фамилия":"Спецакова","Внешний код":"18facc28-2182-11ef-af4a-00155d000910","E-Mail":"SpetsakovaVE@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"10.08.2026 14:16:56","ID":"358","Подразделения":"Дирекция бухгалтерского учета и налоговой отчетности"}
,
{"Логин":"PoklonovaNS","Активность":"Да","Дата изменения":"29.07.2026 05:20:05","Имя":"Наталия","Фамилия":"Поклонова","Внешний код":"ec245c06-aec4-11ee-aeb6-00155d000912","E-Mail":"PoklonovaNS@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"07.08.2026 08:55:19","ID":"359","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"AleshinaAI","Активность":"Да","Дата изменения":"09.06.2026 15:40:30","Имя":"Алена","Фамилия":"Алешина","Внешний код":"ffe2d2c9-ad02-11ed-ad68-00155d000910","E-Mail":"AleshinaAI@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"06.08.2025 09:51:09","ID":"361","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"KlyukinaDS","Активность":"Да","Дата изменения":"04.08.2026 17:33:04","Имя":"Дарья","Фамилия":"Клюкина","Внешний код":"36ce3059-2843-11f1-b1e3-00155d000912","E-Mail":"KlyukinaDS@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"04.08.2026 11:17:33","ID":"362","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"KoptsevaKA","Активность":"Да","Дата изменения":"06.08.2026 05:36:10","Имя":"Кристина","Фамилия":"Копцева","Внешний код":"dda688e8-283e-11f1-b1e3-00155d000912","E-Mail":"KoptsevaKA@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"24.07.2026 15:42:59","ID":"364","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"KoptilkinaIS","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Ирина","Фамилия":"Коптилкина","Внешний код":"964c9246-d15a-11ee-aee2-00155d000910","E-Mail":"koptilkinais@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"10.08.2026 09:17:33","ID":"366","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"KruglovaNG","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Наталья","Фамилия":"Круглова","Внешний код":"ed0d64e9-452f-11eb-aa35-00155d1a381f","E-Mail":"kruglovang@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"","ID":"367","Подразделения":"Группа Web-разработки"}
,
{"Логин":"NatykinaEV","Активность":"Да","Дата изменения":"06.08.2026 05:36:11","Имя":"Елена","Фамилия":"Натыкина","Внешний код":"1dd4c906-cc98-11ee-aedc-00155d000912","E-Mail":"NatykinaEV@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"07.08.2026 11:14:51","ID":"368","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"MakarovGV","Активность":"Да","Дата изменения":"29.07.2026 17:21:04","Имя":"Геннадий","Фамилия":"Макаров","Внешний код":"01b71a82-452f-11eb-aa35-00155d1a381f","E-Mail":"makarovgv@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"13.07.2026 15:29:28","ID":"369","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"MaslovskayaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Анна","Фамилия":"Масловская","Внешний код":"9185c334-fb63-11ec-ac7a-00155d000912","E-Mail":"MaslovskayaAA1@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"10.08.2026 17:19:10","ID":"370","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"TarshilovaDD","Активность":"Да","Дата изменения":"06.08.2026 05:36:11","Имя":"Дарья","Фамилия":"Таршилова","Внешний код":"7a0eded1-eccf-11ee-af07-00155d000910","E-Mail":"tarshilovadd@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"11.08.2026 08:57:00","ID":"371","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"IvanovaSG","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Светлана","Фамилия":"Иванова","Внешний код":"d06e6334-bd28-11eb-aad0-00155d1a381f","E-Mail":"ivanovasg5@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"10.08.2026 09:17:16","ID":"372","Подразделения":"Группа технической поддержки"}
,
{"Логин":"EgorovVI","Активность":"Да","Дата изменения":"14.07.2026 16:51:05","Имя":"Валерий","Фамилия":"Егоров","Внешний код":"904dd76b-efcc-11ed-adbd-00155d000912","E-Mail":"egorovvi8@mos.ru","Дата регистрации":"03.02.2025 17:56:41","Последняя авторизация":"14.07.2026 10:27:06","ID":"373","Подразделения":"Группа Android-разработки"}
,
{"Логин":"UtkinIV","Активность":"Да","Дата изменения":"05.08.2026 17:35:04","Имя":"Иван","Фамилия":"Уткин","Внешний код":"1ecaaf18-2064-11ec-ab4d-00155d051a08","E-Mail":"utkiniv@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 12:14:21","ID":"330","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"ChervaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Александра","Фамилия":"Черва","Внешний код":"8d00bafc-3774-11ef-af66-00155d000910","E-Mail":"chervaaa@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 09:59:22","ID":"331","Подразделения":"Управление закупок"}
,
{"Логин":"KalinushkinMV","Активность":"Да","Дата изменения":"06.08.2026 05:36:09","Имя":"Максим","Фамилия":"Калинушкин","Внешний код":"7454c04a-47fc-11ef-af7b-00155d000910","E-Mail":"kalinushkinmv@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"04.08.2026 11:03:36","ID":"334","Подразделения":"Управление проектирования интерфейсов"}
,
{"Логин":"OlittoAA","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Алиса","Фамилия":"Олитто","Внешний код":"7dc9f951-d604-11ee-aee8-00155d000912","E-Mail":"OlittoAA@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"09.08.2026 08:59:07","ID":"336","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"KolyukanovaMA","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Марина","Фамилия":"Колюканова","Внешний код":"2b59f647-e121-11ea-a9ca-00155d1a381f","E-Mail":"KolyukanovaMA@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 17:43:47","ID":"337","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"ValishinaYV","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Юлия","Фамилия":"Валишина","Внешний код":"8e43091d-c3f2-11ee-aed1-00155d000912","E-Mail":"valishinayv1@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 17:05:38","ID":"338","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"RomashkinaNA","Активность":"Да","Дата изменения":"03.08.2026 17:31:06","Имя":"Надежда","Фамилия":"Ромашкина","Внешний код":"f7373a4a-a0df-11eb-aaac-00155d1a381f","E-Mail":"RomashkinaNA@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"11.08.2026 08:17:39","ID":"339","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"VorontsovaEV","Активность":"Да","Дата изменения":"05.08.2026 17:35:04","Имя":"Екатерина","Фамилия":"Трофимова","Внешний код":"2b241366-97f8-11ee-ae99-00155d000912","E-Mail":"VorontsovaEV4@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 09:30:50","ID":"341","Подразделения":"Управление по работе со странами Азии"}
,
{"Логин":"MeleshkovSO","Активность":"Да","Дата изменения":"09.08.2026 17:43:03","Имя":"Сергей","Фамилия":"Мелешков","Внешний код":"73b515aa-b0ee-11ed-ad6d-00155d000912","E-Mail":"MeleshkovSO@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 13:10:45","ID":"342","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"ChefonovaYI","Активность":"Да","Дата изменения":"31.07.2026 17:25:03","Имя":"Яна","Фамилия":"Чефонова","Внешний код":"d1b2fb48-d0a2-11ee-aee1-00155d000910","E-Mail":"ChefonovaYI@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"07.08.2026 09:07:44","ID":"343","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"DobrotvorskayaAA","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Анастасия","Фамилия":"Добротворская","Внешний код":"bc82d784-4329-11ed-acd7-00155d000912","E-Mail":"DobrotvorskayaAA1@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 16:03:05","ID":"344","Подразделения":"Управление развития корпоративной культуры и мотивации персонала"}
,
{"Логин":"LoshkarevaIA","Активность":"Да","Дата изменения":"03.08.2026 17:31:06","Имя":"Ирина","Фамилия":"Лошкарева","Внешний код":"dc4c0e4d-2e14-11ef-af5a-00155d000910","E-Mail":"LoshkarevaIA@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"11.08.2026 08:24:26","ID":"347","Подразделения":"Дирекция по персоналу"}
,
{"Логин":"ShevkunovDI","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Дмитрий","Фамилия":"Шевкунов","Внешний код":"7cb72567-3670-11ec-ab69-00155d051a08","E-Mail":"shevkunovdi@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"06.08.2026 17:49:57","ID":"348","Подразделения":"Правовое управление"}
,
{"Логин":"KutyrevaNV","Активность":"Да","Дата изменения":"06.08.2026 17:37:05","Имя":"Наталья","Фамилия":"Кутырева","Внешний код":"5ebcf8d2-7701-11ee-ae6e-00155d000912","E-Mail":"KutyrevaNV1@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 17:20:34","ID":"349","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KireevaAV","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Анна","Фамилия":"Киреева","Внешний код":"0bdcc970-7889-11ee-ae70-00155d000912","E-Mail":"KireevaAV4@mos.ru","Дата регистрации":"03.02.2025 17:56:40","Последняя авторизация":"10.08.2026 13:57:32","ID":"350","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"SednevAA","Активность":"Да","Дата изменения":"31.07.2026 17:25:03","Имя":"Андрей","Фамилия":"Седнев","Внешний код":"37e9ba80-82c2-11ee-ae7d-00155d000912","E-Mail":"SednevAA1@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"18.06.2026 09:22:10","ID":"307","Подразделения":"Группа технической поддержки"}
,
{"Логин":"KhertekDA","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Долаана","Фамилия":"Хертек","Внешний код":"7c4588d6-df7e-11ee-aef6-00155d000910","E-Mail":"KhertekDA@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"07.08.2026 13:00:10","ID":"310","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"RubtsovaAY","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Анастасия","Фамилия":"Рубцова","Внешний код":"396728b6-7698-11ef-afb7-00155d000910","E-Mail":"rubtsovaay@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 10:13:57","ID":"312","Подразделения":"Управление развития специальных проектов"}
,
{"Логин":"KhrypchenkoLS","Активность":"Да","Дата изменения":"29.07.2026 05:20:04","Имя":"Любовь","Фамилия":"Хрыпченко","Внешний код":"39f356dc-8ac9-11ef-afd1-00155d000912","E-Mail":"KhrypchenkoLS@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"30.07.2026 19:49:24","ID":"313","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"VybornovAV","Активность":"Да","Дата изменения":"13.07.2026 16:49:10","Имя":"Андрей","Фамилия":"Выборнов","Внешний код":"92b2a526-988c-11eb-aaa1-00155d1a381f","E-Mail":"vybornovav@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"13.07.2026 13:56:41","ID":"314","Подразделения":"Группа тестировщиков"}
,
{"Логин":"RyzhovPB","Активность":"Да","Дата изменения":"23.07.2026 17:09:04","Имя":"Павел","Фамилия":"Рыжов","Внешний код":"1ca7bdc4-f063-11ec-ac6a-00155d000912","E-Mail":"ryzhovpb@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"23.07.2026 14:17:13","ID":"315","Подразделения":"Группа реализации"}
,
{"Логин":"SpiridonovaAY","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Алёна","Фамилия":"Спиридонова","Внешний код":"b9a721ee-70d0-11ef-afaf-00155d000912","E-Mail":"SpiridonovaAY@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 12:22:27","ID":"316","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"BogodukhovaSG","Активность":"Да","Дата изменения":"23.07.2026 17:09:05","Имя":"Снежана","Фамилия":"Богодухова","Внешний код":"17424852-283b-11f1-b1e3-00155d000912","E-Mail":"BogodukhovaSG@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"23.07.2026 09:42:07","ID":"317","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"BazinSS","Активность":"Да","Дата изменения":"04.08.2026 17:33:04","Имя":"Сергей","Фамилия":"Базин","Внешний код":"5a54726c-64b3-11ed-ad03-00155d000910","E-Mail":"BazinSS@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 17:11:12","ID":"319","Подразделения":"Проектная группа"}
,
{"Логин":"KastrovaAV","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Анна","Фамилия":"Кастрова","Внешний код":"f52656dd-2ce6-11ed-acbb-00155d000910","E-Mail":"KastrovaAV@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"11.08.2026 08:50:35","ID":"322","Подразделения":"Группа по подбору персонала"}
,
{"Логин":"MazurovMP","Активность":"Да","Дата изменения":"02.08.2026 17:29:02","Имя":"Михаил","Фамилия":"Мазуров","Внешний код":"6cbb4ea2-a141-11ed-ad57-00155d000912","E-Mail":"MazurovMP@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 16:06:13","ID":"323","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"ZiminSY","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Сергей","Фамилия":"Зимин","Внешний код":"51f7be49-e14c-11ea-a9ca-00155d1a381f","E-Mail":"ziminsy@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 14:51:24","ID":"324","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"TomilovaAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:05","Имя":"Александра","Фамилия":"Томилова","Внешний код":"979da903-ca3c-11ee-aed9-00155d000910","E-Mail":"TomilovaAA1@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 09:12:02","ID":"325","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"ZakharchukAS","Активность":"Да","Дата изменения":"06.08.2026 05:36:09","Имя":"Алиса","Фамилия":"Захарчук","Внешний код":"f10c51d3-cca3-11ee-aedc-00155d000912","E-Mail":"ZakharchukAS@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"07.08.2026 10:08:59","ID":"326","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"KuchkildinAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Андрей","Фамилия":"Кучкильдин","Внешний код":"8a505415-a9ac-11ec-abfd-00155d051a08","E-Mail":"KuchkildinAA@mos.ru","Дата регистрации":"03.02.2025 17:56:39","Последняя авторизация":"10.08.2026 17:47:43","ID":"327","Подразделения":"Специалист по информационной безопасности"}
,
{"Логин":"KireevaDS","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Дарина","Фамилия":"Киреева","Внешний код":"2e73321e-d831-11ed-ad9f-00155d000912","E-Mail":"KireevaDS@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 13:54:40","ID":"285","Подразделения":"Управление развития корпоративной культуры и мотивации персонала"}
,
{"Логин":"TregulovIF","Активность":"Да","Дата изменения":"30.07.2026 05:22:03","Имя":"Ильдар","Фамилия":"Трегулов","Внешний код":"dbd91dce-9690-11ef-afe0-00155d000910","E-Mail":"tregulovif@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"29.07.2026 18:52:29","ID":"286","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"PolyakovaYA","Активность":"Да","Дата изменения":"04.08.2026 17:33:04","Имя":"Юлия","Фамилия":"Полякова","Внешний код":"9b345a0e-d261-11eb-aaeb-00155d1a1df7","E-Mail":"PolyakovaYA@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"11.08.2026 08:50:37","ID":"287","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"YakovlevaTG","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Татьяна","Фамилия":"Яковлева","Внешний код":"97d07e02-e500-11ee-aefd-00155d000912","E-Mail":"YakovlevaTG5@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"07.08.2026 14:16:01","ID":"288","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"BiryukovAA","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Андрей","Фамилия":"Бирюков","Внешний код":"2bfde83d-fb45-11eb-ab1e-00155d051a08","E-Mail":"biryukovaa1@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 09:24:40","ID":"289","Подразделения":"Управление закупок"}
,
{"Логин":"KovalenkoKV","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Ксения","Фамилия":"Коваленко","Внешний код":"196e3c96-9aec-11ed-ad4f-00155d000910","E-Mail":"KovalenkoKV@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 09:32:52","ID":"291","Подразделения":"Управление бизнес-процессами"}
,
{"Логин":"KolesnikovaEK","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Елизавета","Фамилия":"Колесникова","Внешний код":"48f25a5b-f001-11ee-af0b-00155d000912","E-Mail":"kolesnikovaek1@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 10:26:07","ID":"292","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"PavlovEA","Активность":"Да","Дата изменения":"04.08.2026 17:33:04","Имя":"Егор","Фамилия":"Павлов","Внешний код":"651b61c5-29ea-11ee-ae0b-00155d000912","E-Mail":"PavlovEA5@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"04.08.2026 12:48:53","ID":"293","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"VarvaninEN","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Евгений","Фамилия":"Варванин","Внешний код":"1d5c5e96-28b9-11eb-aa10-00155d1a381f","E-Mail":"VarvaninEN@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"11.08.2026 03:33:26","ID":"294","Подразделения":"Дирекция по инфраструктурным проектам"}
,
{"Логин":"YudkinLA","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Лев","Фамилия":"Мартынов","Внешний код":"accb9ef3-3843-11ef-af67-00155d000912","E-Mail":"YudkinLA@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"05.08.2026 11:35:37","ID":"296","Подразделения":"Группа технической поддержки"}
,
{"Логин":"DerbenevaAI","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Алена","Фамилия":"Дербенева","Внешний код":"8c28a49f-f577-11ee-af12-00155d000910","E-Mail":"derbenevaai@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 16:00:19","ID":"297","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"TitkovaEA","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Елена","Фамилия":"Титкова","Внешний код":"c2959716-6f40-11ef-afad-00155d000912","E-Mail":"TitkovaEA2@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 17:27:53","ID":"298","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"SurovDS","Активность":"Да","Дата изменения":"28.07.2026 17:19:03","Имя":"Даниил","Фамилия":"Суров","Внешний код":"f9536d7b-8389-11ee-ae7e-00155d000912","E-Mail":"SurovDS@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"28.07.2026 11:44:53","ID":"299","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"KhlobystovaEP","Активность":"Да","Дата изменения":"11.08.2026 05:46:04","Имя":"Екатерина","Фамилия":"Невзорова","Внешний код":"55e67734-69dd-11eb-aa66-00155d1a381f","E-Mail":"nevzorovaep1@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 22:04:25","ID":"300","Подразделения":"Управление взаиморасчетов с контрагентами"}
,
{"Логин":"ShkelevAA","Активность":"Да","Дата изменения":"06.08.2026 05:36:09","Имя":"Антон","Фамилия":"Шкелев","Внешний код":"23102f09-cefd-11ee-aedf-00155d000910","E-Mail":"ShkelevAA@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"05.08.2026 09:20:59","ID":"301","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"KomarovaES","Активность":"Да","Дата изменения":"06.08.2026 05:36:09","Имя":"Елена","Фамилия":"Комарова","Внешний код":"92c0fb89-3a71-11ee-ae20-00155d000910","E-Mail":"KomarovaES5@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"13.04.2026 16:21:47","ID":"302","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"SinikovaNV","Активность":"Да","Дата изменения":"03.08.2026 05:30:04","Имя":"Наталия","Фамилия":"Василова","Внешний код":"81928312-a391-11ed-ad5a-00155d000910","E-Mail":"sinikovanv@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"04.03.2026 15:54:23","ID":"305","Подразделения":"Управление по взаимодействию с органами власти"}
,
{"Логин":"ObolenskayaTI","Активность":"Да","Дата изменения":"07.08.2026 05:38:02","Имя":"Татьяна","Фамилия":"Оболенская","Внешний код":"5eb3bddf-9e10-11ed-ad53-00155d000912","E-Mail":"ObolenskayaTI@mos.ru","Дата регистрации":"03.02.2025 17:56:38","Последняя авторизация":"10.08.2026 14:56:27","ID":"306","Подразделения":"Группа IOS-разработки"}
,
{"Логин":"BerezhnoySV","Активность":"Да","Дата изменения":"01.08.2026 17:27:02","Имя":"Сергей","Фамилия":"Бережной","Внешний код":"c4786dc9-37ad-11ef-af66-00155d000910","E-Mail":"BerezhnoySV3@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"20.07.2026 17:41:58","ID":"263","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"KuzkinaPG","Активность":"Да","Дата изменения":"13.07.2026 16:49:08","Имя":"Полина","Фамилия":"Кузькина","Внешний код":"fffb5e42-1a39-11ee-adf7-00155d000910","E-Mail":"KuzkinaPG@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"13.07.2026 15:36:42","ID":"264","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"KotelnikovaMB","Активность":"Да","Дата изменения":"05.08.2026 17:35:03","Имя":"Марина","Фамилия":"Котельникова","Внешний код":"26504bd4-c201-11eb-aad6-00155d1a381f","E-Mail":"KotelnikovaMB@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"23.07.2026 09:11:28","ID":"265","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"KatkovaED","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Елена","Фамилия":"Каткова","Внешний код":"c1240b8d-3032-11ee-ae13-00155d000912","E-Mail":"KatkovaED@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 10:07:34","ID":"266","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"MikheevDA","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Денис","Фамилия":"Михеев","Внешний код":"3db60382-aebe-11ee-aeb6-00155d000912","E-Mail":"MikheevDA5@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"07.08.2026 11:26:12","ID":"267","Подразделения":"Управление исследовательских проектов"}
,
{"Логин":"GavrilovaTV","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Татьяна","Фамилия":"Гаврилова","Внешний код":"b58860ea-d4e4-11ec-ac43-00155d000910","E-Mail":"GavrilovaTV5@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"30.07.2026 11:00:57","ID":"268","Подразделения":"Заместитель директора дивизиона - Владелец продукта"}
,
{"Логин":"MechetinAV","Активность":"Да","Дата изменения":"31.07.2026 17:25:03","Имя":"Алексей","Фамилия":"Мечетин","Внешний код":"74cad695-5889-11ef-af90-00155d000912","E-Mail":"MechetinAV@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"23.07.2026 13:52:13","ID":"269","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"YukhanYI","Активность":"Да","Дата изменения":"27.07.2026 17:17:04","Имя":"Юлия","Фамилия":"Ордина","Внешний код":"","E-Mail":"yukhanyi@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"29.07.2026 16:45:51","ID":"271","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"TsapkovskayaLV","Активность":"Да","Дата изменения":"06.08.2026 05:36:08","Имя":"Людмила","Фамилия":"Цапковская","Внешний код":"94c10f5c-ff36-11eb-ab23-00155d051a08","E-Mail":"TsapkovskayaLV1@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"11.08.2026 07:46:39","ID":"272","Подразделения":"Группа охраны труда"}
,
{"Логин":"DvornikovGV","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Георгий","Фамилия":"Дворников","Внешний код":"78c1f69e-48ff-11eb-aa3a-00155d1a381f","E-Mail":"DvornikovGV1@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"13.07.2026 14:01:58","ID":"273","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"GolikovaMV","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Мария","Фамилия":"Голикова","Внешний код":"7da1c38a-8839-11ee-ae84-00155d000910","E-Mail":"GolikovaMV3@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 17:29:04","ID":"275","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"DergachevaAV","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Анна","Фамилия":"Дергачева","Внешний код":"f1bf1f5d-c170-11ed-ad82-00155d000910","E-Mail":"DergachevaAV@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 17:00:06","ID":"276","Подразделения":"Группа по подбору персонала"}
,
{"Логин":"LyavinetsEM","Активность":"Да","Дата изменения":"30.07.2026 17:23:04","Имя":"Евгений","Фамилия":"Лявинец","Внешний код":"c3992bfb-cb73-11ec-ac28-00155d051a08","E-Mail":"LyavinetsEM@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"04.08.2026 18:15:54","ID":"277","Подразделения":"Управление закупок"}
,
{"Логин":"ShitovaKI","Активность":"Да","Дата изменения":"03.08.2026 17:31:05","Имя":"Ксения","Фамилия":"Шитова","Внешний код":"8a9492cc-5709-11eb-aa4d-00155d1a381f","E-Mail":"shitovaki1@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 16:25:39","ID":"279","Подразделения":"Управление работы с данными и отраслевой статистики"}
,
{"Логин":"KovtunenkoAA","Активность":"Да","Дата изменения":"06.08.2026 05:36:08","Имя":"Антон","Фамилия":"Ковтуненко","Внешний код":"07a202ec-714b-11ed-ad13-00155d000910","E-Mail":"KovtunenkoAA@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"05.08.2026 14:33:20","ID":"280","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"PitelAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Анна","Фамилия":"Питель","Внешний код":"95254cb3-f002-11ed-adbd-00155d000912","E-Mail":"PitelAA@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 17:45:20","ID":"281","Подразделения":"Дирекция бухгалтерского учета и налоговой отчетности"}
,
{"Логин":"ChernyshevaAD","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Анастасия","Фамилия":"Чернышева","Внешний код":"14c715f4-1352-11ef-af38-00155d000910","E-Mail":"chernyshevaad@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 09:59:26","ID":"282","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"ChernovAV","Активность":"Да","Дата изменения":"04.08.2026 17:33:04","Имя":"Александр","Фамилия":"Чернов","Внешний код":"32935972-8ef5-11ec-abdb-00155d051a08","E-Mail":"chernovav9@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"04.08.2026 12:28:37","ID":"283","Подразделения":"Управление по координации туристко-экскурсионной деятельности"}
,
{"Логин":"KruglovDM","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Денис","Фамилия":"Круглов","Внешний код":"d8f5f0ab-f22b-11f0-b19d-00155d000910","E-Mail":"kruglovdm@mos.ru","Дата регистрации":"03.02.2025 17:56:37","Последняя авторизация":"10.08.2026 12:51:18","ID":"284","Подразделения":"Правовое управление"}
,
{"Логин":"grachevbv","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Борис","Фамилия":"Грачев","Внешний код":"016f4941-08c3-11ed-ac8b-00155d000910","E-Mail":"grachevbv@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"31.07.2026 09:03:59","ID":"240","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"KovalenkoAA","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Артём","Фамилия":"Коваленко","Внешний код":"8880d308-0854-11ef-af2a-00155d000912","E-Mail":"kovalenkoaa2@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"11.08.2026 08:58:06","ID":"241","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"StupinaKA","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Карина","Фамилия":"Ступина","Внешний код":"ee30f569-5ec1-11ef-af98-00155d000912","E-Mail":"StupinaKA@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"27.07.2026 09:32:42","ID":"244","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"BaranovaEV","Активность":"Да","Дата изменения":"06.08.2026 05:36:07","Имя":"Екатерина","Фамилия":"Баранова","Внешний код":"f0c76e63-bcb6-11ed-ad7c-00155d000910","E-Mail":"BaranovaEV4@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"06.08.2026 16:45:30","ID":"245","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"VitrovTV","Активность":"Да","Дата изменения":"08.08.2026 17:41:03","Имя":"Тимур","Фамилия":"Витров","Внешний код":"c48005b8-53cb-11ef-af8a-00155d000912","E-Mail":"VitrovTV@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"05.08.2026 13:03:23","ID":"246","Подразделения":"Группа технической поддержки"}
,
{"Логин":"MasalitinaAM","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Алла","Фамилия":"Масалитина","Внешний код":"0603082f-89fc-11ef-afd0-00155d000912","E-Mail":"MasalitinaAM@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"10.08.2026 10:55:28","ID":"247","Подразделения":"Управление исследовательских проектов"}
,
{"Логин":"DvoretskayaNV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Нина","Фамилия":"Дворецкая","Внешний код":"9b484d49-27cd-11ef-af52-00155d000910","E-Mail":"DvoretskayaNV1@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"10.08.2026 10:18:16","ID":"248","Подразделения":"Группа технической поддержки"}
,
{"Логин":"MokhovaED","Активность":"Да","Дата изменения":"06.08.2026 05:36:07","Имя":"Елена","Фамилия":"Мохова","Внешний код":"7845e8f3-c461-11ef-b01a-00155d000912","E-Mail":"MokhovaED@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"07.08.2026 13:43:25","ID":"249","Подразделения":"Управление по работе с персоналом"}
,
{"Логин":"AnikeevEA","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Евгений","Фамилия":"Аникеев","Внешний код":"11e887d6-326e-11ed-acc2-00155d000912","E-Mail":"AnikeevEA@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"05.08.2026 15:51:30","ID":"250","Подразделения":"Группа технической поддержки"}
,
{"Логин":"StrakovskiyID","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Илья","Фамилия":"Страковский","Внешний код":"4d8b7384-0374-11ee-add7-00155d000912","E-Mail":"StrakovskiyID@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"04.08.2026 16:40:34","ID":"251","Подразделения":"Заместитель директора дивизиона по IT"}
,
{"Логин":"OzhoginaDV","Активность":"Да","Дата изменения":"05.08.2026 17:35:03","Имя":"Дарья","Фамилия":"Фролова","Внешний код":"3cdf20e7-5073-11ee-ae3d-00155d000912","E-Mail":"OzhoginaDV@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"05.08.2026 17:24:43","ID":"252","Подразделения":"Управление проектирования интерфейсов"}
,
{"Логин":"GlazkovaID","Активность":"Да","Дата изменения":"05.08.2026 05:34:04","Имя":"Ирина","Фамилия":"Глазкова","Внешний код":"c5fd15b2-6441-11ef-af9f-00155d000910","E-Mail":"glazkovaid@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"10.08.2026 09:43:59","ID":"253","Подразделения":"Группа технической поддержки"}
,
{"Логин":"PoltavskayaNA","Активность":"Да","Дата изменения":"06.08.2026 05:36:08","Имя":"Наталья","Фамилия":"Полтавская","Внешний код":"087227c0-4459-11eb-aa34-00155d1a381f","E-Mail":"poltavskayana1@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"","ID":"254","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"SokolovME","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Максим","Фамилия":"Соколов","Внешний код":"27a80cc4-d2b9-11ed-ad98-00155d000910","E-Mail":"SokolovME1@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"10.08.2026 17:51:20","ID":"255","Подразделения":"Управление закупок"}
,
{"Логин":"SergeevaEE","Активность":"Да","Дата изменения":"29.07.2026 17:21:04","Имя":"Екатерина","Фамилия":"Сергеева","Внешний код":"2eae260b-862d-11eb-aa8a-00155d1a381f","E-Mail":"polyakovaee@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"21.03.2025 13:06:01","ID":"257","Подразделения":"Группа тестировщиков"}
,
{"Логин":"BoldenkovaMV","Активность":"Да","Дата изменения":"30.07.2026 17:23:03","Имя":"Мария","Фамилия":"Болденкова","Внешний код":"81d82cfc-4527-11eb-aa35-00155d1a381f","E-Mail":"boldenkovamv@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"30.07.2026 15:09:42","ID":"258","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"MansurovRA","Активность":"Да","Дата изменения":"29.07.2026 05:20:04","Имя":"Ришат","Фамилия":"Мансуров","Внешний код":"de195971-856a-11ef-afca-00155d000910","E-Mail":"mansurovra@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"14.07.2026 09:29:21","ID":"259","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"PavlovaEV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Елена","Фамилия":"Павлова","Внешний код":"a6f412da-0881-11eb-a9e7-00155d1a381f","E-Mail":"PavlovaEV8@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"10.08.2026 12:04:16","ID":"260","Подразделения":"Дирекция бухгалтерского учета и налоговой отчетности"}
,
{"Логин":"AnisimovaVN","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Вера","Фамилия":"Анисимова","Внешний код":"0dfb5bb8-d797-11ee-aeea-00155d000910","E-Mail":"AnisimovaVN@mos.ru","Дата регистрации":"03.02.2025 17:56:36","Последняя авторизация":"13.07.2026 14:12:23","ID":"262","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"BorodkinaID","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Ирина","Фамилия":"Бородкина","Внешний код":"1b337328-cb2e-11ee-aeda-00155d000912","E-Mail":"BorodkinaID@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"26.08.2025 09:50:12","ID":"218","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KukushkinDV","Активность":"Да","Дата изменения":"06.08.2026 05:36:07","Имя":"Данила","Фамилия":"Кукушкин","Внешний код":"cf2adf63-bee5-11ec-ac18-00155d051a08","E-Mail":"KukushkinDV@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"18.06.2026 19:22:19","ID":"219","Подразделения":"Управление проектирования интерфейсов"}
,
{"Логин":"VasilevVA","Активность":"Да","Дата изменения":"30.07.2026 17:23:03","Имя":"Вячеслав","Фамилия":"Васильев","Внешний код":"52a2dedc-7174-11ee-ae67-00155d000910","E-Mail":"VasilevVA18@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"13.07.2026 13:36:18","ID":"220","Подразделения":"Группа тестировщиков"}
,
{"Логин":"KurdzhievaMF","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Марина","Фамилия":"Курджиева","Внешний код":"17367350-d09e-11ee-aee1-00155d000910","E-Mail":"KurdzhievaMF@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"10.08.2026 09:09:48","ID":"222","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"SerpkovaVA","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Вероника","Фамилия":"Серпкова","Внешний код":"7ef91286-fbf0-11ea-a9d8-00155d1a381f","E-Mail":"serpkovava1@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"10.08.2026 10:18:43","ID":"224","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"ShakhumovRS","Активность":"Да","Дата изменения":"06.08.2026 05:36:07","Имя":"Рамазан","Фамилия":"Шахумов","Внешний код":"0d5e4a94-4129-11ec-ab77-00155d051a08","E-Mail":"ShokhumovRS@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"07.07.2026 14:31:50","ID":"225","Подразделения":"Группа IOS-разработки"}
,
{"Логин":"AnnamuhamedovBA","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Батыр","Фамилия":"Аннамухамедов","Внешний код":"626fd319-72b1-11ec-abb7-00155d051a08","E-Mail":"AnnamukhamedovBA1@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"10.08.2026 13:11:03","ID":"226","Подразделения":"Управление работы с данными и отраслевой статистики"}
,
{"Логин":"PastushkovDV","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Дмитрий","Фамилия":"Пастушков","Внешний код":"5327497f-d76f-11ed-ad9e-00155d000912","E-Mail":"PastushkovDV@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"07.08.2026 11:08:43","ID":"227","Подразделения":"Группа реализации"}
,
{"Логин":"PopovaAA","Активность":"Да","Дата изменения":"04.08.2026 05:32:04","Имя":"Анастасия","Фамилия":"Попова","Внешний код":"f3646a00-2835-11f1-b1e3-00155d000912","E-Mail":"PopovaAA3@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"30.07.2026 17:55:38","ID":"228","Подразделения":"Первый заместитель генерального директора по развитию делового туризма"}
,
{"Логин":"MezhievMZ","Активность":"Да","Дата изменения":"15.06.2026 15:53:07","Имя":"Магомед","Фамилия":"Межиев","Внешний код":"8553b16e-2a6e-11ec-ab5a-00155d051a08","E-Mail":"MezhievMZ@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"","ID":"230","Подразделения":"Дирекция по работе со странами Ближнего Востока, Африки и Европы"}
,
{"Логин":"SukhoruchenkoAV","Активность":"Да","Дата изменения":"06.08.2026 05:36:07","Имя":"Алла","Фамилия":"Сухорученко","Внешний код":"851cf7e6-10f8-11ef-af35-00155d000912","E-Mail":"sukhoruchenkoav@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"30.07.2026 15:22:32","ID":"231","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"SazonovIA","Активность":"Да","Дата изменения":"10.07.2026 04:43:05","Имя":"Игорь","Фамилия":"Сазонов","Внешний код":"2e4afa78-0380-11ee-add7-00155d000912","E-Mail":"SazonovIA1@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"","ID":"232","Подразделения":"Группа IOS-разработки"}
,
{"Логин":"TishkovaEV","Активность":"Да","Дата изменения":"10.08.2026 17:45:04","Имя":"Елизавета","Фамилия":"Тишкова","Внешний код":"c5558a81-4004-11ee-ae28-00155d000912","E-Mail":"TishkovaEV2@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"07.08.2026 16:36:57","ID":"234","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"MironovAI","Активность":"Да","Дата изменения":"30.07.2026 17:23:03","Имя":"Андрей","Фамилия":"Миронов","Внешний код":"2bc06777-7fc5-11ef-afc3-00155d000912","E-Mail":"mironovai5@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"07.07.2026 08:48:29","ID":"237","Подразделения":"Группа системных инженеров"}
,
{"Логин":"KryukovAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:04","Имя":"Андрей","Фамилия":"Крюков","Внешний код":"1c0b8fea-7154-11ed-ad13-00155d000910","E-Mail":"KryukovAA3@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"13.07.2026 14:03:36","ID":"238","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"KramorenkoAM","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Анна","Фамилия":"Краморенко","Внешний код":"031c5d46-6999-11ee-ae5d-00155d000912","E-Mail":"kramorenkoam@mos.ru","Дата регистрации":"03.02.2025 17:56:35","Последняя авторизация":"11.08.2026 07:53:25","ID":"239","Подразделения":"Управление по взаимодействию с органами власти"}
,
{"Логин":"NikanorovaMM","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Мария","Фамилия":"Никанорова","Внешний код":"8028cb97-1963-11ed-aca1-00155d000912","E-Mail":"NikanorovaMM@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"","ID":"195","Подразделения":"Первый заместитель генерального директора по внешним коммуникациям"}
,
{"Логин":"SedovaTV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Татьяна","Фамилия":"Седова","Внешний код":"740a6488-b080-11ef-b001-00155d000910","E-Mail":"SedovaTV2@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"05.08.2026 15:40:15","ID":"196","Подразделения":"Генеральный директор"}
,
{"Логин":"PolikarpovaKA","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Карина","Фамилия":"Поликарпова","Внешний код":"9e2bc0ad-4518-11eb-aa35-00155d1a381f","E-Mail":"PolikarpovaKA@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"10.08.2026 09:53:44","ID":"197","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"KorolevaIA","Активность":"Да","Дата изменения":"24.07.2026 05:10:04","Имя":"Ирина","Фамилия":"Королева","Внешний код":"a0baed50-2839-11f1-b1e3-00155d000912","E-Mail":"KorolevaIA13@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"16.07.2026 13:28:39","ID":"201","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"FedulovaMV","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Мария","Фамилия":"Федулова","Внешний код":"4dc742b4-7f40-11ec-abc7-00155d051a08","E-Mail":"FedulovaMV@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"","ID":"202","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"SeleznevaYD","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Юлия","Фамилия":"Селезнева","Внешний код":"abdd223f-7239-11ee-ae68-00155d000912","E-Mail":"SeleznevaYD@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"10.08.2026 17:43:47","ID":"203","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"RogovaIS","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Ирина","Фамилия":"Уралова","Внешний код":"8263f1cc-03df-11ec-ab29-00155d051a08","E-Mail":"RogovaIS@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"08.08.2026 06:26:07","ID":"204","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"PasenkovMV","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Максим","Фамилия":"Пасенков","Внешний код":"1cbe993d-5e6c-11ed-acfa-00155d000912","E-Mail":"PasenkovMV@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"14.07.2026 12:03:40","ID":"206","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"KislyakovaOV","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Ольга","Фамилия":"Кислякова","Внешний код":"24f3fe59-9a4c-11ee-ae9c-00155d000912","E-Mail":"KislyakovaOV@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"30.07.2026 08:07:15","ID":"207","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"OrudzhevRT","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Руслан","Фамилия":"Оруджев","Внешний код":"a51b409c-b670-11ed-ad74-00155d000912","E-Mail":"OrudzhevRT@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"07.08.2026 08:50:31","ID":"208","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"kovalenkoma","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Мария","Фамилия":"Коваленко","Внешний код":"f29c6826-c3ff-11ee-aed1-00155d000912","E-Mail":"kovalenkoma@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"07.08.2026 11:07:46","ID":"210","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"RodkinaAV","Активность":"Да","Дата изменения":"12.06.2026 15:47:06","Имя":"Анастасия","Фамилия":"Родкина","Внешний код":"7bac23ce-cfd4-11ee-aee0-00155d000910","E-Mail":"RodkinaAV@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"17.07.2025 13:21:24","ID":"211","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"PyshnyyIO","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Игорь","Фамилия":"Пышный","Внешний код":"f118430d-d421-11f0-b177-00155d000912","E-Mail":"PyshnyyIO@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"28.07.2026 18:41:26","ID":"212","Подразделения":"Группа разработки интерфейсов"}
,
{"Логин":"KozlovaDA","Активность":"Да","Дата изменения":"06.08.2026 05:36:06","Имя":"Диана","Фамилия":"Козлова","Внешний код":"7d229a3f-15f8-11ec-ab40-00155d051a08","E-Mail":"kozlovada2@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"10.08.2026 14:06:14","ID":"214","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"KosyanovaKM","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Карина","Фамилия":"Косьянова","Внешний код":"e5b6ffc8-b3b5-11ee-aebc-00155d000912","E-Mail":"KosyanovaKM@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"10.08.2026 11:51:01","ID":"215","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"TsyplenkovDO","Активность":"Да","Дата изменения":"24.07.2026 05:10:04","Имя":"Данил","Фамилия":"Цыпленков","Внешний код":"35660c88-8a3f-11ec-abd5-00155d051a08","E-Mail":"TsyplenkovDO@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"14.07.2026 09:49:55","ID":"216","Подразделения":"Группа тестировщиков"}
,
{"Логин":"KilbasAK","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Анастасия","Фамилия":"Цвеловская","Внешний код":"b05b8c78-87fb-11ec-abd2-00155d051a08","E-Mail":"TsvelovskayaAK@mos.ru","Дата регистрации":"03.02.2025 17:56:34","Последняя авторизация":"04.08.2026 14:13:38","ID":"217","Подразделения":"Управление по сопровождению контактного центра"}
,
{"Логин":"LukinaYA","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Юлия","Фамилия":"Лукина","Внешний код":"858ee4bf-7740-11ef-afb8-00155d000912","E-Mail":"LukinaYA4@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 14:17:17","ID":"172","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"BulychkinaAP","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Анна","Фамилия":"Булычкина","Внешний код":"7ce6d857-89ca-11ee-ae86-00155d000912","E-Mail":"BulychkinaAP@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"31.07.2026 11:21:33","ID":"175","Подразделения":"Управление сопровождения контрактов"}
,
{"Логин":"KurilkinaOS","Активность":"Да","Дата изменения":"03.08.2026 17:31:03","Имя":"Ольга","Фамилия":"Сергеевна","Внешний код":"","E-Mail":"KurilkinaOS@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"23.09.2025 16:47:53","ID":"176","Подразделения":""}
,
{"Логин":"KosolobenkovaIA","Активность":"Да","Дата изменения":"07.08.2026 05:38:02","Имя":"Ирина","Фамилия":"Косолобенкова","Внешний код":"1ebd4e56-ea10-11f0-b193-00155d000910","E-Mail":"KosolobenkovaIA@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 16:57:26","ID":"177","Подразделения":"Сметно-договорное управление"}
,
{"Логин":"BrikOV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Ольга","Фамилия":"Брик","Внешний код":"cde31fd6-ce1f-11e9-a994-00155d1a3432","E-Mail":"BrikOV@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 14:47:09","ID":"179","Подразделения":"Расчетно-кассовая группа"}
,
{"Логин":"PodosinovaAE","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Анна","Фамилия":"Подосинова","Внешний код":"cc072493-4e7d-11ea-a99f-00155d1a38ec","E-Mail":"PodosinovaAE@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"04.08.2026 17:59:35","ID":"180","Подразделения":"Группа бухгалтерского и налогового учета"}
,
{"Логин":"UtkinaNE","Активность":"Да","Дата изменения":"05.08.2026 17:35:03","Имя":"Надежда","Фамилия":"Уткина","Внешний код":"d5997c86-4443-11eb-aa34-00155d1a381f","E-Mail":"utkinane@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 10:07:51","ID":"181","Подразделения":"Расчетно-кассовая группа"}
,
{"Логин":"PerovaIV","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Ирина","Фамилия":"Перова","Внешний код":"3d980d7a-e4f4-11ee-aefd-00155d000912","E-Mail":"PerovaIV@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"27.07.2026 11:20:33","ID":"182","Подразделения":"Группа технической поддержки"}
,
{"Логин":"EliseevaGV","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Галина","Фамилия":"Елисеева","Внешний код":"12a524b0-0fb2-11ec-ab38-00155d051a08","E-Mail":"EliseevaGV@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 15:57:42","ID":"183","Подразделения":"Управление документационного обеспечения и контроля"}
,
{"Логин":"EgorenkovaAD","Активность":"Да","Дата изменения":"06.08.2026 17:37:04","Имя":"Анна","Фамилия":"Егоренкова","Внешний код":"138993e5-4a50-11ef-af7e-00155d000912","E-Mail":"EgorenkovaAD@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"10.08.2026 09:19:38","ID":"184","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"PlokhikhVM","Активность":"Да","Дата изменения":"29.07.2026 05:20:03","Имя":"Виктория","Фамилия":"Плохих","Внешний код":"019babf9-10fc-11ef-af35-00155d000912","E-Mail":"PlokhikhVM@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"31.07.2026 12:01:18","ID":"188","Подразделения":"Управление по развитию образовательного и детского туризма"}
,
{"Логин":"KuptsovVS","Активность":"Да","Дата изменения":"31.07.2026 17:25:02","Имя":"Владимир","Фамилия":"Купцов","Внешний код":"340fed1e-9b43-11ef-afe6-00155d000910","E-Mail":"KuptsovVS1@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"06.08.2026 17:38:45","ID":"189","Подразделения":"Управление аналитического сопровождения деятельности"}
,
{"Логин":"AblonskiyRA","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Роман","Фамилия":"Аблонский","Внешний код":"e6954e05-cfc7-11ee-aee0-00155d000910","E-Mail":"AblonskiyRA@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"04.08.2026 10:55:36","ID":"190","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"KurnakinDA","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Дмитрий","Фамилия":"Курнакин","Внешний код":"78ae9ca3-ae91-11ed-ad6a-00155d000912","E-Mail":"KurnakinDA@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"03.08.2026 09:53:58","ID":"191","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"FilatovAY","Активность":"Да","Дата изменения":"30.07.2026 17:23:03","Имя":"Андрей","Фамилия":"Филатов","Внешний код":"43687673-b1b7-11ed-ad6e-00155d000912","E-Mail":"FilatovAY4@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"21.07.2026 10:08:02","ID":"192","Подразделения":"Группа Android-разработки"}
,
{"Логин":"RomanovNE","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Николай","Фамилия":"Романов","Внешний код":"9cb2a5cb-c716-11ee-aed5-00155d000910","E-Mail":"RomanovNE@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"07.08.2026 13:55:58","ID":"193","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"GlazkovaSO","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Софья","Фамилия":"Глазкова","Внешний код":"dd70c9de-f005-11ee-af0b-00155d000912","E-Mail":"GlazkovaSO@mos.ru","Дата регистрации":"03.02.2025 17:56:33","Последняя авторизация":"07.08.2026 14:05:39","ID":"194","Подразделения":"Управление по развитию партнерской сети"}
,
{"Логин":"VenderevskikhIA","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Игорь","Фамилия":"Вендеревских","Внешний код":"6cafe9a7-cf0c-11ee-aedf-00155d000910","E-Mail":"VenderevskikhIA@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 13:23:52","ID":"150","Подразделения":"Группа системного администрирования"}
,
{"Логин":"ErmolaevMN","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Михаил","Фамилия":"Ермолаев","Внешний код":"4014a907-98e5-11ef-afe3-00155d000910","E-Mail":"ErmolaevMN@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 09:20:35","ID":"151","Подразделения":"Административное управление"}
,
{"Логин":"VertunovAA","Активность":"Да","Дата изменения":"06.08.2026 17:37:03","Имя":"Арсений","Фамилия":"Вертунов","Внешний код":"243a43d6-3a9e-11ef-af6a-00155d000912","E-Mail":"VertunovAA@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"06.08.2026 12:29:54","ID":"152","Подразделения":"Группа системного администрирования"}
,
{"Логин":"PudyshevNV","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Никита","Фамилия":"Пудышев","Внешний код":"3f2f9845-e4ac-11f0-b18c-00155d000910","E-Mail":"PudyshevNV@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 12:44:21","ID":"154","Подразделения":"Сметно-договорное управление"}
,
{"Логин":"ZotovaNV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Надежда","Фамилия":"Зотова","Внешний код":"c3bbd52f-4772-11ec-ab7f-00155d051a08","E-Mail":"ZotovaNV@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"11.08.2026 03:04:00","ID":"159","Подразделения":"Управление регионального взаимодействия"}
,
{"Логин":"NefedovaAV","Активность":"Да","Дата изменения":"29.07.2026 05:20:02","Имя":"Анна","Фамилия":"Нефедова","Внешний код":"25273945-a1a8-11eb-aaad-00155d1a381f","E-Mail":"NefedovaAV1@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"12.05.2025 11:10:12","ID":"160","Подразделения":"Заместитель генерального директора по региональному взаимодействию"}
,
{"Логин":"PletnevaEY","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Эльмира","Фамилия":"Плетнева","Внешний код":"d51922ed-7ce8-11ec-abc4-00155d051a08","E-Mail":"PletnevaEY1@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"08.08.2026 03:00:04","ID":"161","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"KuklinaES","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Екатерина","Фамилия":"Куклина","Внешний код":"d30350df-27bf-11ef-af52-00155d000910","E-Mail":"KuklinaES1@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 09:08:59","ID":"162","Подразделения":"Управление онлайн-маркетинга"}
,
{"Логин":"SoldatovaIN","Активность":"Да","Дата изменения":"30.07.2026 17:23:02","Имя":"Ирина","Фамилия":"Солдатова","Внешний код":"c005fd21-44f2-11eb-aa35-00155d1a381f","E-Mail":"SoldatovaIN@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"11.08.2026 03:05:59","ID":"163","Подразделения":"Управление маркетинговых коммуникаций"}
,
{"Логин":"BelyavtsevaMS","Активность":"Да","Дата изменения":"03.08.2026 17:31:03","Имя":"Мария","Фамилия":"Белявцева","Внешний код":"a6fd3571-4ac2-11ed-ace1-00155d000912","E-Mail":"BelyavtsevaMS@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 17:39:32","ID":"164","Подразделения":"Управление по связям с общественностью"}
,
{"Логин":"GyulerKN","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Ксения","Фамилия":"Гюлер","Внешний код":"fa999387-44f0-11eb-aa35-00155d1a381f","E-Mail":"GyulerKN@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"04.08.2026 18:21:13","ID":"166","Подразделения":"Дирекция рекламы и электронных продаж"}
,
{"Логин":"TarasovaDM","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Дарья","Фамилия":"Тарасова","Внешний код":"2a3337ea-363b-11ec-ab69-00155d051a08","E-Mail":"TarasovaDM@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"10.08.2026 12:57:06","ID":"170","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"KasatkinAV","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Алексей","Фамилия":"Касаткин","Внешний код":"612b8ab3-33eb-11f1-b1f2-00155d000912","E-Mail":"KasatkinAV@mos.ru","Дата регистрации":"03.02.2025 17:56:32","Последняя авторизация":"05.08.2026 15:48:05","ID":"171","Подразделения":"Управление закупок"}
,
{"Логин":"PrezhentsevEM","Активность":"Да","Дата изменения":"09.07.2026 16:42:03","Имя":"Егор","Фамилия":"Преженцев","Внешний код":"e8af0642-d26b-11eb-aaeb-00155d1a1df7","E-Mail":"PrezhentsevEM@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"09.07.2026 10:01:01","ID":"128","Подразделения":"Управление онлайн-маркетинга"}
,
{"Логин":"KorkhovAV1","Активность":"Да","Дата изменения":"15.07.2026 04:52:05","Имя":"Александр","Фамилия":"Корхов","Внешний код":"b1c9e4b8-faf8-11ee-af19-00155d000912","E-Mail":"KorkhovAV1@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"06.07.2026 17:00:13","ID":"129","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"GusevaII","Активность":"Да","Дата изменения":"06.08.2026 05:36:04","Имя":"Ирина","Фамилия":"Брагина","Внешний код":"9bdddad5-76ea-11ee-ae6e-00155d000912","E-Mail":"BraginaII@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"07.08.2026 14:39:11","ID":"133","Подразделения":"Управление онлайн-маркетинга"}
,
{"Логин":"BulgakovaPV","Активность":"Да","Дата изменения":"11.08.2026 05:46:03","Имя":"Полина","Фамилия":"Булгакова","Внешний код":"e1d7e283-be58-11ed-ad7e-00155d000912","E-Mail":"BulgakovaPV@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 10:23:54","ID":"134","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"SibagatullinaLD","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Лейсан","Фамилия":"Сибагатуллина","Внешний код":"5dd6f624-2174-11ef-af4a-00155d000910","E-Mail":"SibagatullinaLD@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 09:29:57","ID":"136","Подразделения":"Управление развития коммерческих партнерств"}
,
{"Логин":"BaumanEM","Активность":"Да","Дата изменения":"06.08.2026 17:37:03","Имя":"Елена","Фамилия":"Бауман","Внешний код":"d1459439-af85-11ee-aeb7-00155d000912","E-Mail":"BaumanEM@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 19:09:23","ID":"138","Подразделения":"Управление сопровождения маркетинговой деятельности"}
,
{"Логин":"KurachevaOA","Активность":"Да","Дата изменения":"03.08.2026 17:31:03","Имя":"Ольга","Фамилия":"Курачева","Внешний код":"4a86071b-8a02-11ef-afd0-00155d000912","E-Mail":"KurachevaOA@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 17:03:56","ID":"141","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"VasilevaTA","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Татьяна","Фамилия":"Васильева","Внешний код":"331cb5d0-87de-11ec-abd2-00155d051a08","E-Mail":"VasilevaTA3@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 10:03:04","ID":"142","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"ZlobinaSA","Активность":"Да","Дата изменения":"07.08.2026 05:38:02","Имя":"Светлана","Фамилия":"Злобина","Внешний код":"7569eb11-4275-11ef-af74-00155d000912","E-Mail":"ZlobinaSA@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"11.08.2026 08:28:51","ID":"144","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"MakeevaEA","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Елена","Фамилия":"Макеева","Внешний код":"196219e4-d3d1-11e9-a994-00155d1a3432","E-Mail":"MakeevaEA@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 23:22:51","ID":"145","Подразделения":"Заместитель генерального директора по финансам"}
,
{"Логин":"LukyanovaIP","Активность":"Да","Дата изменения":"06.08.2026 05:36:05","Имя":"Ирина","Фамилия":"Лукьянова","Внешний код":"28f82a1a-787f-11ee-ae70-00155d000912","E-Mail":"LukyanovaIP@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"07.08.2026 09:14:02","ID":"147","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"ShiryaevaAA","Активность":"Да","Дата изменения":"03.08.2026 17:31:03","Имя":"Анна","Фамилия":"Ширяева","Внешний код":"a6aee82d-be81-11ee-aeca-00155d000912","E-Mail":"ShiryaevaAA4@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"06.08.2026 12:01:48","ID":"148","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"ParfenovaTB","Активность":"Да","Дата изменения":"07.08.2026 17:39:03","Имя":"Татьяна","Фамилия":"Парфенова","Внешний код":"69057e6e-6e86-11ea-a9a4-00155d1a230c","E-Mail":"ParfenovaTB@mos.ru","Дата регистрации":"03.02.2025 17:56:31","Последняя авторизация":"10.08.2026 14:18:29","ID":"149","Подразделения":"Планово-экономическое управление"}
,
{"Логин":"VarfolomeevAV","Активность":"Да","Дата изменения":"05.02.2025 10:20:10","Имя":"Андрей","Фамилия":"Варфоломеев","Внешний код":"","E-Mail":"VarfolomeevAV3@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"","ID":"107","Подразделения":""}
,
{"Логин":"AkhromenkoAV","Активность":"Да","Дата изменения":"05.02.2025 10:20:02","Имя":"Александр","Фамилия":"Ахроменко","Внешний код":"","E-Mail":"AkhromenkoAV@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"","ID":"108","Подразделения":""}
,
{"Логин":"PotapovaAS","Активность":"Да","Дата изменения":"06.08.2026 05:36:04","Имя":"Александра","Фамилия":"Потапова","Внешний код":"93b15bd0-3bf1-11e9-a98f-00155d1a3433","E-Mail":"PotapovaAS@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"03.08.2026 16:28:13","ID":"109","Подразделения":"Дирекция программно-целевого развития"}
,
{"Логин":"SmirnovaDV","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Дария","Фамилия":"Спивакова","Внешний код":"3b522b37-1d8b-11ef-af45-00155d000912","E-Mail":"SmirnovaDV4@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"07.08.2026 15:38:38","ID":"110","Подразделения":"Группа технической поддержки"}
,
{"Логин":"VavilinPA","Активность":"Да","Дата изменения":"06.08.2026 17:37:03","Имя":"Павел","Фамилия":"Вавилин","Внешний код":"079a9b79-8b97-11ef-afd2-00155d000912","E-Mail":"VavilinPA@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"06.08.2026 12:18:44","ID":"111","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"PlekhovMV","Активность":"Да","Дата изменения":"31.07.2026 17:25:02","Имя":"Михаил","Фамилия":"Плехов","Внешний код":"368efd5a-664e-11ed-ad05-00155d000910","E-Mail":"PlekhovMV@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"31.07.2026 17:08:00","ID":"112","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"SchevchenkoES","Активность":"Да","Дата изменения":"06.08.2026 17:37:03","Имя":"Евгения","Фамилия":"Шевченко","Внешний код":"6799679c-dc02-11ec-ac4e-00155d000912","E-Mail":"ShevchenkoES1@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"06.08.2026 11:55:17","ID":"113","Подразделения":"Управление нормативно-правового регулирования и законодательных инициатив"}
,
{"Логин":"ValeevDR","Активность":"Да","Дата изменения":"29.07.2026 05:20:02","Имя":"Денис","Фамилия":"Валеев","Внешний код":"1ec86f36-536e-11ed-acec-00155d000912","E-Mail":"ValeevDR1@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"25.06.2026 15:42:35","ID":"114","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"MikhaylovAS","Активность":"Да","Дата изменения":"23.07.2026 17:09:03","Имя":"Александр","Фамилия":"Михайлов","Внешний код":"3b2f519d-3908-11ef-af68-00155d000912","E-Mail":"MikhaylovAS4@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"23.07.2026 13:21:44","ID":"115","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"NovitskayaVA","Активность":"Да","Дата изменения":"23.06.2026 16:08:02","Имя":"Владислава","Фамилия":"Новицкая","Внешний код":"77d184cd-8632-11ef-afcb-00155d000910","E-Mail":"novitskayava1@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"23.06.2026 13:06:03","ID":"117","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"BabaevaZF","Активность":"Да","Дата изменения":"05.08.2026 05:34:03","Имя":"Зарина","Фамилия":"Бабаева","Внешний код":"82492613-6bef-11ee-ae60-00155d000910","E-Mail":"BabaevaZF@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"15.07.2026 14:20:09","ID":"120","Подразделения":"Дирекция по работе со странами Ближнего Востока, Африки и Европы"}
,
{"Логин":"MkrtchyanMT","Активность":"Да","Дата изменения":"09.06.2026 15:40:05","Имя":"Мария","Фамилия":"Мкртчян","Внешний код":"d7ac7ccb-4b64-11ec-ab84-00155d051a08","E-Mail":"MkrtchyanMT@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"","ID":"122","Подразделения":"Управление бизнес-процессами"}
,
{"Логин":"VatakhAA","Активность":"Да","Дата изменения":"15.07.2026 04:52:05","Имя":"Анастасия","Фамилия":"Ватах","Внешний код":"93b52554-01b3-11ed-ac82-00155d000912","E-Mail":"VatakhAA@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"07.07.2026 14:21:00","ID":"123","Подразделения":"Советник"}
,
{"Логин":"PerekhodAA","Активность":"Да","Дата изменения":"04.08.2026 17:33:03","Имя":"Артур","Фамилия":"Переход","Внешний код":"b7fcb954-283d-11f1-b1e3-00155d000912","E-Mail":"PerekhodAA@mos.ru","Дата регистрации":"03.02.2025 17:56:30","Последняя авторизация":"04.08.2026 15:31:32","ID":"126","Подразделения":"Управление по организации конгрессно-выставочной деятельности"}
,
{"Логин":"AlekseevAV22","Активность":"Да","Дата изменения":"05.08.2026 17:35:03","Имя":"Антон","Фамилия":"Алексеев","Внешний код":"4eae540f-7151-11ed-ad13-00155d000910","E-Mail":"AlekseevAV22@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"05.08.2026 13:15:59","ID":"86","Подразделения":"Управление развития"}
,
{"Логин":"VasyuninEA","Активность":"Да","Дата изменения":"21.07.2026 17:05:02","Имя":"Егор","Фамилия":"Васюнин","Внешний код":"","E-Mail":"VasyuninEA@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"21.07.2026 15:39:43","ID":"87","Подразделения":"Управление развития"}
,
{"Логин":"TyurinaAA","Активность":"Да","Дата изменения":"30.07.2026 17:23:02","Имя":"Анна","Фамилия":"Тюрина","Внешний код":"f3cb3aa3-3ff3-11ee-ae28-00155d000912","E-Mail":"TyurinaAA6@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"30.07.2026 15:34:04","ID":"88","Подразделения":"Управление развития"}
,
{"Логин":"IzotovaES","Активность":"Да","Дата изменения":"22.07.2026 17:07:02","Имя":"Евгения","Фамилия":"Изотова","Внешний код":"974dced0-6827-11ea-a9a2-00155d1a230c","E-Mail":"izotovaes@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"22.07.2026 09:49:43","ID":"89","Подразделения":"Управление нормативно-правового регулирования и законодательных инициатив"}
,
{"Логин":"MurashevskayaTV","Активность":"Да","Дата изменения":"06.08.2026 05:36:04","Имя":"Татьяна","Фамилия":"Мурашевская","Внешний код":"09abed97-1846-11eb-a9fb-00155d1a381f","E-Mail":"MurashevskayaTV@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"05.08.2026 18:00:29","ID":"90","Подразделения":"Управление нормативно-правового регулирования и законодательных инициатив"}
,
{"Логин":"UkolovaEN","Активность":"Да","Дата изменения":"28.07.2026 17:19:02","Имя":"Елена","Фамилия":"Уколова","Внешний код":"84badf17-13f9-11e9-a98f-00155d1a3433","E-Mail":"UkolovaEN@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"28.07.2026 16:20:20","ID":"91","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"PalminaMA","Активность":"Да","Дата изменения":"06.08.2026 05:36:04","Имя":"Мария","Фамилия":"Пальмина","Внешний код":"8c62f6af-0bbb-11ec-ab33-00155d051a08","E-Mail":"palminama2@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"","ID":"92","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"TitovaEN5","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Елена","Фамилия":"Титова","Внешний код":"ac5d5ad3-c58f-11ee-aed3-00155d000912","E-Mail":"TitovaEN5@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"10.08.2026 09:16:59","ID":"93","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"ChagdurovaLV","Активность":"Да","Дата изменения":"10.08.2026 17:45:03","Имя":"Лариса","Фамилия":"Чагдурова","Внешний код":"4b5684c4-3316-11eb-aa1d-00155d1a381f","E-Mail":"ChagdurovaLV@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"10.08.2026 10:06:14","ID":"94","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"PylovaNS","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Наталья","Фамилия":"Пылова","Внешний код":"84badf29-13f9-11e9-a98f-00155d1a3433","E-Mail":"pylovans@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"07.08.2026 15:54:55","ID":"95","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"GubarevaAP","Активность":"Да","Дата изменения":"14.07.2026 04:50:02","Имя":"Алёна","Фамилия":"Губарева","Внешний код":"ad15fa76-7995-11ef-afbb-00155d000912","E-Mail":"GubarevaAP1@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"","ID":"98","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"KuzinaAD","Активность":"Да","Дата изменения":"29.07.2026 05:20:02","Имя":"Анастасия","Фамилия":"Кузина","Внешний код":"a0b22568-797e-11ef-afbb-00155d000912","E-Mail":"KuzinaAD1@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"06.07.2026 19:06:49","ID":"99","Подразделения":"Управление дизайна"}
,
{"Логин":"MalofeevIY","Активность":"Да","Дата изменения":"29.07.2026 05:20:02","Имя":"Иван","Фамилия":"Малофеев","Внешний код":"a957daac-7aba-11ed-ad1f-00155d000910","E-Mail":"MalofeevIY@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"","ID":"101","Подразделения":"Дирекция общегородских проектов"}
,
{"Логин":"BerestovskayaOV","Активность":"Да","Дата изменения":"28.07.2026 17:19:03","Имя":"Ольга","Фамилия":"Берестовская","Внешний код":"dc50e517-2187-11ef-af4a-00155d000910","E-Mail":"BerestovskayaOV@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"28.07.2026 09:32:44","ID":"102","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"ChubchenkoMM","Активность":"Да","Дата изменения":"06.08.2026 17:37:03","Имя":"Марина","Фамилия":"Чубченко","Внешний код":"7bcff80d-49fb-11ed-ace0-00155d000910","E-Mail":"ChubchenkoMM1@mos.ru","Дата регистрации":"03.02.2025 17:56:29","Последняя авторизация":"06.08.2026 12:42:58","ID":"104","Подразделения":"Управление координации деятельности и организационного сопровождения"}
,
{"Логин":"ZelenovAA","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Александр","Фамилия":"Зеленов","Внешний код":"79ef6a35-d405-11f0-b177-00155d000912","E-Mail":"ZelenovAA@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"04.08.2026 14:44:42","ID":"60","Подразделения":"Управление по реализации внешних проектов"}
,
{"Логин":"morozovany","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Нина","Фамилия":"Морозова","Внешний код":"09be8e0e-c239-11ed-ad83-00155d000912","E-Mail":"morozovany5@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"07.08.2026 11:10:12","ID":"61","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"ebaranova","Активность":"Да","Дата изменения":"05.02.2025 10:20:02","Имя":"Елена","Фамилия":"Баранова","Внешний код":"","E-Mail":"BaranovaEG3@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"","ID":"63","Подразделения":""}
,
{"Логин":"aemelyanova","Активность":"Да","Дата изменения":"05.02.2025 10:20:03","Имя":"Анастасия","Фамилия":"Емельянова","Внешний код":"","E-Mail":"EmelyanovaAV5@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"","ID":"65","Подразделения":""}
,
{"Логин":"mshmeleva","Активность":"Да","Дата изменения":"30.04.2026 14:24:12","Имя":"Марина","Фамилия":"Шмелева","Внешний код":"","E-Mail":"ShmelevaMO@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"","ID":"66","Подразделения":""}
,
{"Логин":"SamosudovaEE","Активность":"Да","Дата изменения":"14.07.2026 16:51:03","Имя":"Екатерина","Фамилия":"Самосудова","Внешний код":"225e7ab8-1b05-11ee-adf8-00155d000912","E-Mail":"SamosudovaEE@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"14.07.2026 16:41:50","ID":"73","Подразделения":"Управление контент-маркетинга"}
,
{"Логин":"NekhlopochinaIS","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Инна","Фамилия":"Нехлопочина","Внешний код":"341bb5b8-650e-11ef-afa0-00155d000912","E-Mail":"NekhlopochinaIS@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"10.08.2026 08:03:08","ID":"75","Подразделения":"Управление программно-целевого планирования"}
,
{"Логин":"PavlushkinaMA","Активность":"Да","Дата изменения":"06.08.2026 05:36:04","Имя":"Мария","Фамилия":"Павлушкина","Внешний код":"9b84090c-445c-11eb-aa34-00155d1a381f","E-Mail":"pavlushkinama1@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"","ID":"76","Подразделения":"Управление по работе с контентом"}
,
{"Логин":"ShmakovaNS","Активность":"Да","Дата изменения":"10.08.2026 17:45:02","Имя":"Нина","Фамилия":"Шмакова","Внешний код":"fef4a26f-2837-11f1-b1e3-00155d000912","E-Mail":"ShmakovaNS1@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"27.07.2026 13:24:28","ID":"77","Подразделения":"Управление по развитию делового туризма"}
,
{"Логин":"RakusMS","Активность":"Да","Дата изменения":"29.07.2026 17:21:03","Имя":"Мария","Фамилия":"Ракус","Внешний код":"d37c2ad4-aa93-11f0-b140-00155d000912","E-Mail":"RakusMS@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"13.07.2026 14:04:23","ID":"78","Подразделения":"Управление развития кадрового потенциала отрасли"}
,
{"Логин":"MolochkovaNA","Активность":"Да","Дата изменения":"10.07.2026 04:43:03","Имя":"Наталья","Фамилия":"Молочкова","Внешний код":"67f91578-b1cf-11ed-ad6e-00155d000912","E-Mail":"MolochkovaNA@mos.ru","Дата регистрации":"03.02.2025 17:56:28","Последняя авторизация":"","ID":"79","Подразделения":"Заместитель генерального директора по международному сотрудничеству и общегородским проектам"}
,
{"Логин":"LushnikovaEP","Активность":"Да","Дата изменения":"30.05.2026 03:20:02","Имя":"Елена","Фамилия":"Лушникова","Внешний код":"","E-Mail":"lushnikovaep@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"","ID":"38","Подразделения":""}
,
{"Логин":"AnurovaMA","Активность":"Да","Дата изменения":"30.07.2026 17:23:02","Имя":"Майя","Фамилия":"Анурова","Внешний код":"96af2245-2837-11f1-b1e3-00155d000912","E-Mail":"AnurovaMA@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"30.07.2026 15:10:36","ID":"43","Подразделения":"Дирекция по развитию делового туризма и организации конгрессно-выставочной деятельности"}
,
{"Логин":"VoevodinaEM","Активность":"Да","Дата изменения":"14.06.2026 15:51:04","Имя":"Екатерина","Фамилия":"Воеводина","Внешний код":"","E-Mail":"voevodinaem@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"","ID":"47","Подразделения":""}
,
{"Логин":"grigii","Активность":"Да","Дата изменения":"27.07.2026 17:17:02","Имя":"Инесса","Фамилия":"Григ","Внешний код":"Григ","E-Mail":"GrigII@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"26.05.2026 10:46:16","ID":"48","Подразделения":""}
,
{"Логин":"VeltmanKM","Активность":"Да","Дата изменения":"25.06.2026 04:13:03","Имя":"Кристина","Фамилия":"Вельтман","Внешний код":"1356a8e3-23d8-11ef-af4d-00155d000912","E-Mail":"veltmankm@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"","ID":"49","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"YusupovEE","Активность":"Да","Дата изменения":"23.07.2026 17:09:02","Имя":"Егор","Фамилия":"Юсупов","Внешний код":"213045e0-3f5a-11ef-af70-00155d000910","E-Mail":"YusupovEE@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"23.07.2026 15:29:06","ID":"51","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"zuevds","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Дмитрий","Фамилия":"Зуев","Внешний код":"f79f89ff-dfe6-11ec-ac53-00155d000912","E-Mail":"zuevds@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"07.08.2026 15:36:22","ID":"53","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"MokhnaYN","Активность":"Да","Дата изменения":"06.07.2026 16:35:03","Имя":"Юрий","Фамилия":"Мохна","Внешний код":"2db1df4f-4f5e-11ef-af84-00155d000910","E-Mail":"MokhnaYN1@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"18.06.2026 17:08:59","ID":"54","Подразделения":"Группа тестировщиков"}
,
{"Логин":"BryzgachevVV","Активность":"Да","Дата изменения":"14.07.2026 04:50:02","Имя":"Вячеслав","Фамилия":"Брызгачев","Внешний код":"d8cb765d-4ac7-11ed-ace1-00155d000912","E-Mail":"BryzgachevVV@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"13.07.2026 17:48:06","ID":"56","Подразделения":"Группа разработки внутренних систем"}
,
{"Логин":"MazurovVA","Активность":"Да","Дата изменения":"10.08.2026 17:45:02","Имя":"Виталий","Фамилия":"Мазуров","Внешний код":"293f94a4-dd72-11eb-aaf8-00155d051a08","E-Mail":"mazurovva@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"06.08.2026 09:05:11","ID":"57","Подразделения":"Группа технической поддержки"}
,
{"Логин":"FedorovFI","Активность":"Да","Дата изменения":"29.07.2026 05:20:02","Имя":"Филипп","Фамилия":"Федоров","Внешний код":"178e788a-58ed-11ed-acf3-00155d000912","E-Mail":"fedorovfi2@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"24.07.2026 10:24:14","ID":"58","Подразделения":"Группа технической поддержки"}
,
{"Логин":"TolkanovKA","Активность":"Да","Дата изменения":"24.07.2026 17:11:02","Имя":"Константин","Фамилия":"Толканов","Внешний код":"0ca348e2-e12d-11ea-a9ca-00155d1a381f","E-Mail":"tolkanovka@mos.ru","Дата регистрации":"03.02.2025 17:56:27","Последняя авторизация":"24.07.2026 14:03:42","ID":"59","Подразделения":"Управление бизнес-процессами"}
,
{"Логин":"KalashnikovAY","Активность":"Да","Дата изменения":"07.08.2026 17:39:02","Имя":"Алексей","Фамилия":"Калашников","Внешний код":"82c59175-d2c1-11ed-ad98-00155d000910","E-Mail":"KalashnikovAY3@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"10.08.2026 16:37:15","ID":"19","Подразделения":"Группа системного администрирования"}
,
{"Логин":"MatveevBN","Активность":"Да","Дата изменения":"10.08.2026 17:45:02","Имя":"Борис","Фамилия":"Матвеев","Внешний код":"50153bc9-379c-11ef-af66-00155d000910","E-Mail":"matveevbn@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"07.08.2026 09:18:07","ID":"20","Подразделения":"Группа системного администрирования"}
,
{"Логин":"ChadinRM","Активность":"Да","Дата изменения":"06.08.2026 05:36:02","Имя":"Руслан","Фамилия":"Чадин","Внешний код":"5ca3e68b-4530-11eb-aa35-00155d1a381f","E-Mail":"chadinrm@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"","ID":"22","Подразделения":"Группа технической поддержки"}
,
{"Логин":"SuvorovaNV","Активность":"Да","Дата изменения":"18.06.2026 15:58:02","Имя":"Наталья","Фамилия":"Суворова","Внешний код":"","E-Mail":"SuvorovaNV@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"","ID":"25","Подразделения":""}
,
{"Логин":"UdachinaYI","Активность":"Да","Дата изменения":"13.07.2026 16:49:03","Имя":"Юлия","Фамилия":"Удачина","Внешний код":"57107999-c3d4-11ed-ad85-00155d000912","E-Mail":"UdachinaYI@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"13.07.2026 14:28:17","ID":"26","Подразделения":"Группа владельцев продукта"}
,
{"Логин":"LatariaNM","Активность":"Да","Дата изменения":"18.06.2026 15:58:02","Имя":"Нико","Фамилия":"Латариа","Внешний код":"","E-Mail":"LatariaNM@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"","ID":"29","Подразделения":""}
,
{"Логин":"MikheykinaNA","Активность":"Да","Дата изменения":"11.08.2026 05:46:02","Имя":"Наталья","Фамилия":"Михейкина","Внешний код":"85915079-a361-11ec-abf5-00155d051a08","E-Mail":"MikheykinaNA@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"08.08.2025 14:09:54","ID":"30","Подразделения":"Директор дивизиона"}
,
{"Логин":"SmetankinaOV","Активность":"Да","Дата изменения":"07.08.2026 17:39:02","Имя":"Ольга","Фамилия":"Сметанкина","Внешний код":"05b975a3-4e0f-11ed-ace5-00155d000910","E-Mail":"SmetankinaOV@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"07.08.2026 09:44:48","ID":"32","Подразделения":"Группа системных аналитиков"}
,
{"Логин":"NurmukhanovBA","Активность":"Да","Дата изменения":"01.07.2026 16:25:03","Имя":"Булат","Фамилия":"Нурмуханов","Внешний код":"","E-Mail":"NurmukhanovBA@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"01.07.2026 18:08:05","ID":"33","Подразделения":""}
,
{"Логин":"baranovaaa","Активность":"Да","Дата изменения":"05.02.2025 10:20:02","Имя":"Анна","Фамилия":"Баранова","Внешний код":"","E-Mail":"BaranovaAA10@mos.ru","Дата регистрации":"03.02.2025 17:56:26","Последняя авторизация":"","ID":"35","Подразделения":""}
,
{"Логин":"MedvedevSV","Активность":"Да","Дата изменения":"10.08.2026 17:45:02","Имя":"Сергей","Фамилия":"Медведев","Внешний код":"35e97c60-795c-11ee-ae71-00155d000910","E-Mail":"MedvedevSV6@mos.ru","Дата регистрации":"03.02.2025 17:56:25","Последняя авторизация":"11.08.2026 08:50:00","ID":"9","Подразделения":"Группа системного администрирования"}
,
{"Логин":"admin","Активность":"Да","Дата изменения":"28.05.2025 14:12:46","Имя":"Александр","Фамилия":"Александров","Внешний код":"","E-Mail":"admin@localhost.local","Дата регистрации":"19.12.2024 11:05:11","Последняя авторизация":"11.08.2026 04:02:48","ID":"1","Подразделения":""}

]
'
;

$arCorpJsonDecoded = json_decode($jsonFileCorp, true);

foreach ($arCorpJsonDecoded as $item){
    if (empty($item['Внешний код'])){
        $arCorpJsonDecodedEmptyXML_ID[$item['E-Mail']]=$item['Внешний код'];
    }
}


$arRes=array_intersect_key($jsonFileMasurovNew1,$jsonFileMasurovNew1);


pretty_print($arCorpJsonDecodedEmptyXML_ID);

pretty_print($jsonFileMasurovNew1);
//pretty_print($arRes);

/*$arJsonDecoded = json_decode($jsonFile, true);
// Пропускаем заголовки
$usersData = array_slice($arJsonDecoded, 2);

// emails как ключи массив от Мазурова с ИД 1с овскими для Внешнего кода в портале
foreach ($usersData as $userDecoded) {
    $usersDataN[strtolower($userDecoded['field3'])] = $userDecoded;// к нижнему регистру
}

// получаем активных юзеров с пустым Внешним кодом и логином не имеющим "@mos.ru" то есть не из Комитета и из МУФ
$result = UserTable::getList([
    'select' => ['ID', 'XML_ID', 'EMAIL', 'LOGIN'],           // выбираем все поля пользователя
    'filter' => [
        '=ACTIVE' => 'Y',
        'XML_ID' => '',
        '!%LOGIN' => '@mos.ru',     // Логин НЕ содержит символ "@mos.ru"

    ],
    'order' => ['ID' => 'ASC']
]);

$usersNeedsXML_ID = [];
while ($user = $result->fetch()) {
    $usersNeedsXML_ID[strtolower($user['EMAIL'])] = $user;// чтобы совпадали почты
}

// находим совпадения почт в Мазурова файле и в портале(все в нижнем портале)
$matchEmails = array_intersect_key($usersNeedsXML_ID, $usersDataN);

$itemsInChunks =20;// чем больше тем меньше чанков
$chunkNumb = 1;// номер ключ чанка в массиве


$arChunksSplit = array_chunk($matchEmails, $itemsInChunks);// если много делим на части




pretty_print($usersDataN, '$usersDataN from json Mazurov');

pretty_print($usersNeedsXML_ID, '$usersNeedsXML_ID юзеры нужен Вн. код');

pretty_print($matchEmails, '$matchEmails'); // совпадение почт из Маз. и из  портала to needs XML_ID

pretty_print($arChunksSplit, '$arChunksSplit'); // общий с чанками

pretty_print($arChunksSplit[$chunkNumb], 'chunk номер'.$chunkNumb); // массив
*/



?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>