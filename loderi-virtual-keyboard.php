<?php
/*
Plugin Name: Loderi Virtual Keyboard
Version: 1.2
Author: jj1981ua
Author URI: http://loderi.com
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

function loderikbrd_add_meta_box() {
  $screens = array( 'post', 'page' );

  foreach ( $screens as $screen ) {
    add_meta_box(
      'loderikbrd_sectionid',
      __( 'Loderi Virtual Keyboard', 'loderikbrd_textdomain' ),
      'loderikbrd_meta_box_callback',
      $screen,
      'side'
    );
  }
}
add_action( 'add_meta_boxes', 'loderikbrd_add_meta_box' );

function _getLayoutSelectOptions() {
  return '
    <optgroup label="AL">
      <option value="AL Albanian" label="Albanian">Albanian</option>
    </optgroup>
    <optgroup label="AM">
      <option value="AM Armenian Eastern" label="Armenian Eastern">Armenian Eastern</option>
      <option value="AM Armenian Western" label="Armenian Western">Armenian Western</option>
    </optgroup>
    <optgroup label="ANCIENT">
      <option value="ANCIENT Anglo-Frisian" label="Anglo-Frisian">Anglo-Frisian</option>
      <option value="ANCIENT Elder Futhark" label="Elder Futhark">Elder Futhark</option>
      <option value="ANCIENT Glagolitic" label="Glagolitic">Glagolitic</option>
      <option value="ANCIENT Gothic" label="Gothic">Gothic</option>
      <option value="ANCIENT Ogham" label="Ogham">Ogham</option>
      <option value="ANCIENT Younger Futhark" label="Younger Futhark">Younger Futhark</option>
    </optgroup>
    <optgroup label="AZ">
      <option value="AZ Azeri Cyrillic" label="Azeri Cyrillic">Azeri Cyrillic</option>
      <option value="AZ Azeri Latin" label="Azeri Latin">Azeri Latin</option>
    </optgroup>
    <optgroup label="BA">
      <option value="BA Bosnian" label="Bosnian">Bosnian</option>
      <option value="BA Bosnian Cyrillic" label="Bosnian Cyrillic">Bosnian Cyrillic</option>
    </optgroup>
    <optgroup label="BD">
      <option value="BD Unijoy" label="Unijoy">Unijoy</option>
    </optgroup>
    <optgroup label="BE">
      <option value="BE Belgian (Comma)" label="Belgian (Comma)">Belgian (Comma)</option>
    </optgroup>
    <optgroup label="BG">
      <option value="BG Bulgarian" label="Bulgarian">Bulgarian</option>
      <option value="BG Bulgarian (Latin)" label="Bulgarian (Latin)">Bulgarian (Latin)</option>
      <option value="BG Bulgarian Phonetic" label="Bulgarian Phonetic">Bulgarian Phonetic</option>
    </optgroup>
    <optgroup label="BI">
      <option value="BI Kirundi" label="Kirundi">Kirundi</option>
    </optgroup>
    <optgroup label="BJ">
      <option value="BJ Gbe" label="Gbe">Gbe</option>
    </optgroup>
    <optgroup label="BLA">
      <option value="BLA Blackfoot Phonetic" label="Blackfoot Phonetic">Blackfoot Phonetic</option>
    </optgroup>
    <optgroup label="BR">
      <option value="BR Portuguese (Brazilian ABNT)" label="Portuguese (Brazilian ABNT)">Portuguese (Brazilian ABNT)</option>
      <option value="BR Portuguese (Brazilian ABNT2)" label="Portuguese (Brazilian ABNT2)">Portuguese (Brazilian ABNT2)</option>
    </optgroup>
    <optgroup label="BT">
      <option value="BT Delam Tibetan" label="Delam Tibetan">Delam Tibetan</option>
      <option value="BT Dzongkha" label="Dzongkha">Dzongkha</option>
    </optgroup>
    <optgroup label="BW">
      <option value="BW Tswana" label="Tswana">Tswana</option>
    </optgroup>
    <optgroup label="BY">
      <option value="BY Belarusian" label="Belarusian">Belarusian</option>
    </optgroup>
    <optgroup label="CA">
      <option value="CA Canadian French" label="Canadian French">Canadian French</option>
      <option value="CA Canadian French (Legacy)" label="Canadian French (Legacy)">Canadian French (Legacy)</option>
      <option value="CA Canadian Multilingual Standard" label="Canadian Multilingual Standard">Canadian Multilingual Standard</option>
    </optgroup>
    <optgroup label="CE">
      <option value="CE Chechen Cyrillic" label="Chechen Cyrillic">Chechen Cyrillic</option>
      <option value="CE Chechen Latin" label="Chechen Latin">Chechen Latin</option>
    </optgroup>
    <optgroup label="CG">
      <option value="CG Lingala" label="Lingala">Lingala</option>
    </optgroup>
    <optgroup label="CH">
      <option value="CH Swiss French" label="Swiss French">Swiss French</option>
      <option value="CH Swiss German" label="Swiss German">Swiss German</option>
    </optgroup>
    <optgroup label="CHR">
      <option value="CHR Cherokee Phonetic" label="Cherokee Phonetic">Cherokee Phonetic</option>
    </optgroup>
    <optgroup label="CI">
      <option value="CI Baule" label="Baule">Baule</option>
    </optgroup>
    <optgroup label="CM">
      <option value="CM Duala" label="Duala">Duala</option>
      <option value="CM Ewondo" label="Ewondo">Ewondo</option>
      <option value="CM Fulfulde" label="Fulfulde">Fulfulde</option>
    </optgroup>
    <optgroup label="CN">
      <option value="CN Chinese Cangjie" label="Chinese Cangjie">Chinese Cangjie</option>
      <option value="CN Chinese Simpl. Pinyin" label="Chinese Simpl. Pinyin">Chinese Simpl. Pinyin</option>
      <option value="CN Chinese Trad. Pinyin" label="Chinese Trad. Pinyin">Chinese Trad. Pinyin</option>
    </optgroup>
    <optgroup label="CZ">
      <option value="CZ Czech" label="Czech">Czech</option>
      <option value="CZ Czech (QWERTY)" label="Czech (QWERTY)">Czech (QWERTY)</option>
      <option value="CZ Czech Programmers" label="Czech Programmers">Czech Programmers</option>
    </optgroup>
    <optgroup label="DE">
      <option value="DE German" label="German">German</option>
      <option value="DE German (IBM)" label="German (IBM)">German (IBM)</option>
    </optgroup>
    <optgroup label="DIN">
      <option value="DIN Dinka" label="Dinka">Dinka</option>
    </optgroup>
    <optgroup label="DK">
      <option value="DK Danish" label="Danish">Danish</option>
    </optgroup>
    <optgroup label="EE">
      <option value="EE Estonian" label="Estonian">Estonian</option>
    </optgroup>
    <optgroup label="EG">
      <option value="EG Pashto-FSI" label="Pashto-FSI">Pashto-FSI</option>
    </optgroup>
    <optgroup label="ES">
      <option value="ES Spanish" label="Spanish">Spanish</option>
      <option value="ES Spanish Variation" label="Spanish Variation">Spanish Variation</option>
    </optgroup>
    <optgroup label="ET">
      <option value="ET Ethiopic  Pan-Amharic" label="Ethiopic  Pan-Amharic">Ethiopic  Pan-Amharic</option>
      <option value="ET Ethiopic WashRa" label="Ethiopic WashRa">Ethiopic WashRa</option>
      <option value="ET Ethiopic XTT" label="Ethiopic XTT">Ethiopic XTT</option>
      <option value="ET Oromo" label="Oromo">Oromo</option>
    </optgroup>
    <optgroup label="FI">
      <option value="FI Finnish" label="Finnish">Finnish</option>
    </optgroup>
    <optgroup label="FO">
      <option value="FO Faeroese" label="Faeroese">Faeroese</option>
    </optgroup>
    <optgroup label="FR">
      <option value="FR French" label="French">French</option>
      <option value="FR French - linux" label="French - linux">French - linux</option>
    </optgroup>
    <optgroup label="GB">
      <option value="GB UK International" label="UK International">UK International</option>
      <option value="GB UK Qwerty-Maltron" label="UK Qwerty-Maltron">UK Qwerty-Maltron</option>
      <option value="GB United Kingdom" label="United Kingdom">United Kingdom</option>
      <option value="GB United Kingdom Extended" label="United Kingdom Extended">United Kingdom Extended</option>
      <option value="GB United Kingdom-Dvorak" label="United Kingdom-Dvorak">United Kingdom-Dvorak</option>
    </optgroup>
    <optgroup label="GE">
      <option value="GE Georgian" label="Georgian">Georgian</option>
      <option value="GE Georgian QWERTY" label="Georgian QWERTY">Georgian QWERTY</option>
      <option value="GE Georgian ergonomic" label="Georgian ergonomic">Georgian ergonomic</option>
    </optgroup>
    <optgroup label="GH">
      <option value="GH Akan" label="Akan">Akan</option>
      <option value="GH Ga" label="Ga">Ga</option>
    </optgroup>
    <optgroup label="GL">
      <option value="GL Grenland" label="Grenland">Grenland</option>
    </optgroup>
    <optgroup label="GN">
      <option value="GN Mande" label="Mande">Mande</option>
    </optgroup>
    <optgroup label="GR">
      <option value="GR Greek" label="Greek">Greek</option>
      <option value="GR Greek (220)" label="Greek (220)">Greek (220)</option>
      <option value="GR Greek (220) Latin" label="Greek (220) Latin">Greek (220) Latin</option>
      <option value="GR Greek (319)" label="Greek (319)">Greek (319)</option>
      <option value="GR Greek (319) Latin" label="Greek (319) Latin">Greek (319) Latin</option>
      <option value="GR Greek Latin" label="Greek Latin">Greek Latin</option>
      <option value="GR Greek Polytonic" label="Greek Polytonic">Greek Polytonic</option>
    </optgroup>
    <optgroup label="HR">
      <option value="HR Croatian" label="Croatian">Croatian</option>
    </optgroup>
    <optgroup label="HU">
      <option value="HU Hungarian" label="Hungarian">Hungarian</option>
      <option value="HU Hungarian 101-key" label="Hungarian 101-key">Hungarian 101-key</option>
    </optgroup>
    <optgroup label="IE">
      <option value="IE Gaelic" label="Gaelic">Gaelic</option>
      <option value="IE Irish" label="Irish">Irish</option>
    </optgroup>
    <optgroup label="IKU">
      <option value="IKU Inuktitut - nakvitot" label="Inuktitut - nakvitot">Inuktitut - nakvitot</option>
      <option value="IKU Inuktitut Phonetic" label="Inuktitut Phonetic">Inuktitut Phonetic</option>
      <option value="IKU Inuktitut Syllabic" label="Inuktitut Syllabic">Inuktitut Syllabic</option>
      <option value="IKU Inuktitut latin" label="Inuktitut latin">Inuktitut latin</option>
    </optgroup>
    <optgroup label="IL">
      <option value="IL Biblical Hebrew (SIL)" label="Biblical Hebrew (SIL)">Biblical Hebrew (SIL)</option>
      <option value="IL Biblical Hebrew (Tiro)" label="Biblical Hebrew (Tiro)">Biblical Hebrew (Tiro)</option>
      <option value="IL Hebrew" label="Hebrew">Hebrew</option>
    </optgroup>
    <optgroup label="IN">
      <option value="IN Assamese Inscript" label="Assamese Inscript">Assamese Inscript</option>
      <option value="IN BN Inscript Improved" label="BN Inscript Improved">BN Inscript Improved</option>
      <option value="IN Bengali" label="Bengali">Bengali</option>
      <option value="IN Bengali (Inscript)" label="Bengali (Inscript)">Bengali (Inscript)</option>
      <option value="IN Devanagari - INSCRIPT" label="Devanagari - INSCRIPT">Devanagari - INSCRIPT</option>
      <option value="IN Gujarati" label="Gujarati">Gujarati</option>
      <option value="IN Hindi (Inscript)" label="Hindi (Inscript)">Hindi (Inscript)</option>
      <option value="IN Hindi Traditional" label="Hindi Traditional">Hindi Traditional</option>
      <option value="IN Kannada" label="Kannada">Kannada</option>
      <option value="IN Malayalam" label="Malayalam">Malayalam</option>
      <option value="IN Marathi" label="Marathi">Marathi</option>
      <option value="IN Probhat Phonetic" label="Probhat Phonetic">Probhat Phonetic</option>
      <option value="IN Punjabi" label="Punjabi">Punjabi</option>
      <option value="IN Sanskrit Romanized" label="Sanskrit Romanized">Sanskrit Romanized</option>
      <option value="IN Sinhala Indic" label="Sinhala Indic">Sinhala Indic</option>
      <option value="IN Tamil" label="Tamil">Tamil</option>
      <option value="IN Telugu" label="Telugu">Telugu</option>
    </optgroup>
    <optgroup label="IPA">
      <option value="IPA IPA Phonetic" label="IPA Phonetic">IPA Phonetic</option>
    </optgroup>
    <optgroup label="IQ">
      <option value="IQ Arabic" label="Arabic">Arabic</option>
    </optgroup>
    <optgroup label="IR">
      <option value="IR Farsi" label="Farsi">Farsi</option>
      <option value="IR Persian standard" label="Persian standard">Persian standard</option>
    </optgroup>
    <optgroup label="IS">
      <option value="IS Icelandic" label="Icelandic">Icelandic</option>
    </optgroup>
    <optgroup label="IT">
      <option value="IT Italian" label="Italian">Italian</option>
      <option value="IT Italian (142)" label="Italian (142)">Italian (142)</option>
    </optgroup>
    <optgroup label="JP">
      <option value="JP Japanese" label="Japanese">Japanese</option>
    </optgroup>
    <optgroup label="KE">
      <option value="KE Kikuyu" label="Kikuyu">Kikuyu</option>
      <option value="KE Luo" label="Luo">Luo</option>
    </optgroup>
    <optgroup label="KG">
      <option value="KG Kyrgyz Cyrillic" label="Kyrgyz Cyrillic">Kyrgyz Cyrillic</option>
    </optgroup>
    <optgroup label="KH">
      <option value="KH Khmer" label="Khmer">Khmer</option>
    </optgroup>
    <optgroup label="KM">
      <option value="KM Khmer (NIDA 1.0)" label="Khmer (NIDA 1.0)">Khmer (NIDA 1.0)</option>
    </optgroup>
    <optgroup label="KR">
      <option value="KR 2 Beolsik" label="2 Beolsik">2 Beolsik</option>
      <option value="KR 3 Beolsik" label="3 Beolsik">3 Beolsik</option>
      <option value="KR Ru-Kor" label="Ru-Kor">Ru-Kor</option>
    </optgroup>
    <optgroup label="KU">
      <option value="KU Kurdish Arabic" label="Kurdish Arabic">Kurdish Arabic</option>
      <option value="KU Kurdish Cyrillic" label="Kurdish Cyrillic">Kurdish Cyrillic</option>
      <option value="KU Kurdish Latin" label="Kurdish Latin">Kurdish Latin</option>
    </optgroup>
    <optgroup label="KZ">
      <option value="KZ Kazakh" label="Kazakh">Kazakh</option>
    </optgroup>
    <optgroup label="LA">
      <option value="LA Lakhota Standard" label="Lakhota Standard">Lakhota Standard</option>
      <option value="LA Lao" label="Lao">Lao</option>
    </optgroup>
    <optgroup label="LAO">
      <option value="LAO Lao SengKeo" label="Lao SengKeo">Lao SengKeo</option>
    </optgroup>
    <optgroup label="LS">
      <option value="LS seSotho" label="seSotho">seSotho</option>
    </optgroup>
    <optgroup label="LT">
      <option value="LT Lithuanian" label="Lithuanian">Lithuanian</option>
      <option value="LT Lithuanian IBM" label="Lithuanian IBM">Lithuanian IBM</option>
      <option value="LT Lithuanian extended" label="Lithuanian extended">Lithuanian extended</option>
    </optgroup>
    <optgroup label="LU">
      <option value="LU Luxembourgish " label="Luxembourgish ">Luxembourgish</option>
    </optgroup>
    <optgroup label="LV">
      <option value="LV Latvian" label="Latvian">Latvian</option>
      <option value="LV Latvian (QWERTY)" label="Latvian (QWERTY)">Latvian (QWERTY)</option>
    </optgroup>
    <optgroup label="MK">
      <option value="MK Macedonian" label="Macedonian">Macedonian</option>
    </optgroup>
    <optgroup label="ML">
      <option value="ML Bambara" label="Bambara">Bambara</option>
    </optgroup>
    <optgroup label="MM">
      <option value="MM Zawgyi Myanmar" label="Zawgyi Myanmar">Zawgyi Myanmar</option>
    </optgroup>
    <optgroup label="MN">
      <option value="MN Mongolian Cyrillic" label="Mongolian Cyrillic">Mongolian Cyrillic</option>
      <option value="MN Mongolian Cyrillic (QWERTY)" label="Mongolian Cyrillic (QWERTY)">Mongolian Cyrillic (QWERTY)</option>
    </optgroup>
    <optgroup label="MT">
      <option value="MT Maltese 47-key" label="Maltese 47-key">Maltese 47-key</option>
      <option value="MT Maltese 48-key" label="Maltese 48-key">Maltese 48-key</option>
    </optgroup>
    <optgroup label="MV">
      <option value="MV Divehi Phonetic" label="Divehi Phonetic">Divehi Phonetic</option>
      <option value="MV Divehi Typewriter" label="Divehi Typewriter">Divehi Typewriter</option>
    </optgroup>
    <optgroup label="MW">
      <option value="MW Chichewa" label="Chichewa">Chichewa</option>
    </optgroup>
    <optgroup label="MX">
      <option value="MX Latin American" label="Latin American">Latin American</option>
    </optgroup>
    <optgroup label="NG">
      <option value="NG Bassa" label="Bassa">Bassa</option>
      <option value="NG Ebo" label="Ebo">Ebo</option>
      <option value="NG Hausa" label="Hausa">Hausa</option>
      <option value="NG Igbo" label="Igbo">Igbo</option>
      <option value="NG Yoruba" label="Yoruba">Yoruba</option>
    </optgroup>
    <optgroup label="NL">
      <option value="NL Dutch" label="Dutch">Dutch</option>
    </optgroup>
    <optgroup label="NO">
      <option value="NO Norwegian" label="Norwegian">Norwegian</option>
      <option value="NO Norwegian with Sami" label="Norwegian with Sami">Norwegian with Sami</option>
      <option value="NO Sami Extended Norway" label="Sami Extended Norway">Sami Extended Norway</option>
    </optgroup>
    <optgroup label="NP">
      <option value="NP Nepali " label="Nepali ">Nepali</option>
    </optgroup>
    <optgroup label="NZ">
      <option value="NZ Maori" label="Maori">Maori</option>
      <option value="NZ Maori-Dvorak (Two-Handed)" label="Maori-Dvorak (Two-Handed)">Maori-Dvorak (Two-Handed)</option>
    </optgroup>
    <optgroup label="PK">
      <option value="PK Urdu" label="Urdu">Urdu</option>
      <option value="PK Urdu - Madni" label="Urdu - Madni">Urdu - Madni</option>
      <option value="PK Urdu Arabic" label="Urdu Arabic">Urdu Arabic</option>
      <option value="PK Urdu CRULP Phonetic" label="Urdu CRULP Phonetic">Urdu CRULP Phonetic</option>
      <option value="PK Urdu Inpage Monotype" label="Urdu Inpage Monotype">Urdu Inpage Monotype</option>
      <option value="PK Urdu Phonetic" label="Urdu Phonetic">Urdu Phonetic</option>
    </optgroup>
    <optgroup label="PL">
      <option value="PL Polish (214)" label="Polish (214)">Polish (214)</option>
      <option value="PL Polish (Programmers)" label="Polish (Programmers)">Polish (Programmers)</option>
    </optgroup>
    <optgroup label="PRS">
      <option value="PRS Dari" label="Dari">Dari</option>
    </optgroup>
    <optgroup label="PT">
      <option value="PT Portuguese" label="Portuguese">Portuguese</option>
    </optgroup>
    <optgroup label="RO">
      <option value="RO Romanian" label="Romanian">Romanian</option>
    </optgroup>
    <optgroup label="RU">
      <option value="RU Bashkir" label="Bashkir">Bashkir</option>
      <option value="RU Russian" label="Russian">Russian</option>
      <option value="RU Russian (Diktor)" label="Russian (Diktor)">Russian (Diktor)</option>
      <option value="RU Russian (Mac)" label="Russian (Mac)">Russian (Mac)</option>
      <option value="RU Russian (Typewriter)" label="Russian (Typewriter)">Russian (Typewriter)</option>
      <option value="RU Russian Translit" label="Russian Translit">Russian Translit</option>
      <option value="RU Russian ЯЖЕРТЫ" label="Russian ЯЖЕРТЫ">Russian ЯЖЕРТЫ</option>
      <option value="RU Russian_Qwerty" label="Russian_Qwerty">Russian_Qwerty</option>
      <option value="RU Tatar" label="Tatar">Tatar</option>
    </optgroup>
    <optgroup label="SA">
      <option value="SA Arabic (101)" label="Arabic (101)">Arabic (101)</option>
      <option value="SA Arabic (102) AZERTY" label="Arabic (102) AZERTY">Arabic (102) AZERTY</option>
    </optgroup>
    <optgroup label="SE">
      <option value="SE Finnish with Sami" label="Finnish with Sami">Finnish with Sami</option>
      <option value="SE Sami Extended Finland-Sweden" label="Sami Extended Finland-Sweden">Sami Extended Finland-Sweden</option>
      <option value="SE Swedish" label="Swedish">Swedish</option>
      <option value="SE Swedish Dvorak A1" label="Swedish Dvorak A1">Swedish Dvorak A1</option>
      <option value="SE Swedish with Sami" label="Swedish with Sami">Swedish with Sami</option>
    </optgroup>
    <optgroup label="SI">
      <option value="SI Slovenian" label="Slovenian">Slovenian</option>
    </optgroup>
    <optgroup label="SK">
      <option value="SK Slovak" label="Slovak">Slovak</option>
      <option value="SK Slovak (QWERTY)" label="Slovak (QWERTY)">Slovak (QWERTY)</option>
    </optgroup>
    <optgroup label="SL">
      <option value="SL Krio" label="Krio">Krio</option>
    </optgroup>
    <optgroup label="SN">
      <option value="SN Senegal Multilingual" label="Senegal Multilingual">Senegal Multilingual</option>
      <option value="SN Wolof" label="Wolof">Wolof</option>
    </optgroup>
    <optgroup label="SO">
      <option value="SO Somali" label="Somali">Somali</option>
    </optgroup>
    <optgroup label="SP">
      <option value="SP Serbian (Cyrillic)" label="Serbian (Cyrillic)">Serbian (Cyrillic)</option>
      <option value="SP Serbian (Latin)" label="Serbian (Latin)">Serbian (Latin)</option>
    </optgroup>
    <optgroup label="SY">
      <option value="SY Syriac" label="Syriac">Syriac</option>
      <option value="SY Syriac Phonetic" label="Syriac Phonetic">Syriac Phonetic</option>
    </optgroup>
    <optgroup label="TG">
      <option value="TG Tajik Latin" label="Tajik Latin">Tajik Latin</option>
    </optgroup>
    <optgroup label="TH">
      <option value="TH Thai" label="Thai">Thai</option>
      <option value="TH Thai Kedmanee" label="Thai Kedmanee">Thai Kedmanee</option>
      <option value="TH Thai Pattachote" label="Thai Pattachote">Thai Pattachote</option>
    </optgroup>
    <optgroup label="TK">
      <option value="TK Turkmen Cyrillic" label="Turkmen Cyrillic">Turkmen Cyrillic</option>
    </optgroup>
    <optgroup label="TL">
      <option value="TL Tagalog - Tausug" label="Tagalog - Tausug">Tagalog - Tausug</option>
    </optgroup>
    <optgroup label="TR">
      <option value="TR Turkish F" label="Turkish F">Turkish F</option>
      <option value="TR Turkish Q" label="Turkish Q">Turkish Q</option>
    </optgroup>
    <optgroup label="TZ">
      <option value="TZ Swahili" label="Swahili">Swahili</option>
    </optgroup>
    <optgroup label="UA">
      <option value="UA Ukrainian" label="Ukrainian">Ukrainian</option>
      <option value="UA Ukrainian Phonetic" label="Ukrainian Phonetic">Ukrainian Phonetic</option>
      <option value="UA Ukrainian Translit" label="Ukrainian Translit">Ukrainian Translit</option>
    </optgroup>
    <optgroup label="UG">
      <option value="UG Luganda" label="Luganda">Luganda</option>
      <option value="UG Uighur Arabic" label="Uighur Arabic">Uighur Arabic</option>
      <option value="UG Uighur Cyrillic" label="Uighur Cyrillic">Uighur Cyrillic</option>
      <option value="UG Uighur Latin" label="Uighur Latin">Uighur Latin</option>
    </optgroup>
    <optgroup label="US">
      <option value="US Colemak" label="Colemak">Colemak</option>
      <option value="US US" label="US">US</option>
      <option value="US US (Mac)" label="US (Mac)">US (Mac)</option>
      <option value="US US English + Cyrillic" label="US English + Cyrillic">US English + Cyrillic</option>
      <option value="US United States-Dvorak" label="United States-Dvorak">United States-Dvorak</option>
      <option value="US United States-Dvorak left" label="United States-Dvorak left">United States-Dvorak left</option>
      <option value="US United States-Dvorak right" label="United States-Dvorak right">United States-Dvorak right</option>
      <option value="US United States-International" label="United States-International">United States-International</option>
    </optgroup>
    <optgroup label="UZ">
      <option value="UZ Uzbek Cyrillic" label="Uzbek Cyrillic">Uzbek Cyrillic</option>
    </optgroup>
    <optgroup label="VN">
      <option value="VN Vietnamese" label="Vietnamese">Vietnamese</option>
    </optgroup>
    <optgroup label="ZA">
      <option value="ZA Xhosa" label="Xhosa">Xhosa</option>
      <option value="ZA Zulu" label="Zulu">Zulu</option>
    </optgroup>
    <optgroup label="ZM">
      <option value="ZM Bemba" label="Bemba">Bemba</option>
    </optgroup>
    <optgroup label="ZW">
      <option value="ZW Shona" label="Shona">Shona</option>
    </optgroup>
  ';
}

function _getSkinsArray() {
  return array(
    'air_small',
    'air_large',
    'air_mid',
    'flat_gray',
    'goldie',
    'small',
    'soberTouch',
    'textual',
    'winxp'
  );
}

function _getLangcodeAndLink( $language = '' ) {
  if ( !empty( $language ) ) {
    $kbrd_links = array(
      'akan-virtual-keyboard-online',
      'albanian-virtual-keyboard-online',
      'arabic-virtual-keyboard-online',
      'armenian-virtual-keyboard-online',
      'azeri-virtual-keyboard-online',
      'bambara-virtual-keyboard-online',
      'belarusian-virtual-keyboard-online',
      'bemba-virtual-keyboard-online',
      'bengali-virtual-keyboard-online',
      'blackfoot-virtual-keyboard-online',
      'bosnian-virtual-keyboard-online',
      'bulgarian-virtual-keyboard-online',
      'chechen-virtual-keyboard-online',
      'cherokee-virtual-keyboard-online',
      'chichewa-virtual-keyboard-online',
      'chinese-virtual-keyboard-online',
      'croatian-virtual-keyboard-online',
      'czech-virtual-keyboard-online',
      'danish-virtual-keyboard-online',
      'dari-virtual-keyboard-online',
      'devanagari-virtual-keyboard-online',
      'dinka-virtual-keyboard-online',
      'divehi-virtual-keyboard-online',
      'duala-virtual-keyboard-online',
      'dutch-virtual-keyboard-online',
      'dzongkha-virtual-keyboard-online',
      'english-virtual-keyboard-online',
      'estonian-virtual-keyboard-online',
      'ethiopic-virtual-keyboard-online',
      'ewondo-virtual-keyboard-online',
      'faeroese-virtual-keyboard-online',
      'farsi-persian-virtual-keyboard',
      'finnish-virtual-keyboard-online',
      'french-virtual-keyboard-online',
      'fulfulde-virtual-keyboard-online',
      'ga-virtual-keyboard-online',
      'gaelic-virtual-keyboard-online',
      'gbe-virtual-keyboard-online',
      'georgian-virtual-keyboard-online',
      'german-virtual-keyboard-online',
      'greek-virtual-keyboard-online',
      'gujarati-virtual-keyboard-online',
      'hausa-virtual-keyboard-online',
      'hebrew-virtual-keyboard-online',
      'hindi-virtual-keyboard-online',
      'hungarian-virtual-keyboard-online',
      'icelandic-virtual-keyboard-online',
      'igbo-virtual-keyboard-online',
      'irish-virtual-keyboard-online',
      'japanese-virtual-keyboard-online',
      'kannada-virtual-keyboard-online',
      'kazakh-virtual-keyboard-online',
      'khmer-virtual-keyboard-online',
      'kikuyu-virtual-keyboard-online',
      'kirundi-virtual-keyboard-online',
      'korean-virtual-keyboard-online',
      'krio-virtual-keyboard-online',
      'kru-languages-virtual-keyboard',
      'kurdish-virtual-keyboard-online',
      'kyrgyz-virtual-keyboard-online',
      'lakhota-virtual-keyboard-online',
      'lao-virtual-keyboard-online',
      'latvian-virtual-keyboard-online',
      'lingala-virtual-keyboard-online',
      'lithuanian-virtual-keyboard-online',
      'luganda-virtual-keyboard-online',
      'luo-virtual-keyboard-online',
      'luxembourgish-virtual-keyboard-online',
      'macedonian-virtual-keyboard-online',
      'malayalam-virtual-keyboard-online',
      'maltese-virtual-keyboard-online',
      'mande-virtual-keyboard-online',
      'maori-virtual-keyboard-online',
      'marathi-virtual-keyboard-online',
      'mongolian-virtual-keyboard-online',
      'multilingual-virtual-keyboard-online',
      'nepali-virtual-keyboard-online',
      'norwegian-virtual-keyboard-online',
      'oromo-virtual-keyboard-online',
      'pashto-virtual-keyboard-online',
      'polish-virtual-keyboard-online',
      'portuguese-virtual-keyboard-online',
      'romanian-virtual-keyboard-online',
      'russian-virtual-keyboard-online',
      'sanskrit-virtual-keyboard-online',
      'serbian-virtual-keyboard-online',
      'shona-virtual-keyboard-online',
      'slovak-virtual-keyboard-online',
      'slovenian-virtual-keyboard-online',
      'somali-virtual-keyboard-online',
      'spanish-virtual-keyboard-online',
      'swahili-virtual-keyboard-online',
      'swedish-virtual-keyboard-online',
      'syriac-virtual-keyboard-online',
      'tagalog-virtual-keyboard-online',
      'tajik-virtual-keyboard-online',
      'tamil-virtual-keyboard-online',
      'tatar-virtual-keyboard-online',
      'telugu-virtual-keyboard-online',
      'thai-virtual-keyboard-online',
      'tswana-virtual-keyboard-online',
      'turkish-virtual-keyboard-online',
      'turkmen-virtual-keyboard-online',
      'uighur-virtual-keyboard-online',
      'ukrainian-virtual-keyboard-online',
      'urdu-virtual-keyboard-online',
      'uzbek-virtual-keyboard-online',
      'vietnamese-virtual-keyboard-online',
      'wolof-virtual-keyboard-online',
      'xhosa-virtual-keyboard-online',
      'yoruba-virtual-keyboard-online',
      'zulu-virtual-keyboard-online',
      'sesotho-virtual-keyboard-online'
    );

    $arr  = explode( ' ', $language );
    $link = in_array(strtolower($arr[1]) . '-virtual-keyboard-online', $kbrd_links) ? '/' . strtolower($arr[1]) . '-virtual-keyboard-online' : '';

    return array( $arr[0], $link );
  }
}

function loderikbrd_meta_box_callback( $post ) {
  wp_nonce_field( 'loderikbrd_save_meta_box_data', 'loderikbrd_meta_box_nonce' );

  $language = get_post_meta( $post->ID, '_loderi_kbrd_language', true );
  $type = get_post_meta( $post->ID, '_loderi_kbrd_type', true );  //'. ($type == 'kbrd_full') ? ' selected' : '' .'

  echo '<p><label for="loderikbrd_kbrd_enabled">';
  _e( 'Enabled', 'loderikbrd_textdomain' );
  echo '</label>&nbsp;';
  echo '<input type="checkbox" id="loderikbrd_kbrd_enabled" name="loderikbrd_kbrd_enabled" ' . (get_post_meta( $post->ID, '_loderi_kbrd_enabled', true ) ? 'checked' : '') . '/></p>';

   echo '<p><label for="loderikbrd_kbrd_type">';
  _e( 'Type', 'loderikbrd_textdomain' );
  echo '</label><br/>';
  echo '<select unselectable="on" id="loderikbrd_kbrd_type" name="loderikbrd_kbrd_type">';
  echo '<option value="kbrd_widget" label="Widget"';
  echo ($type == 'kbrd_widget') ? ' selected' : '';
  echo '>Widget</option>';
  echo '<option value="kbrd_full" label="Full keyboard"';
  echo ($type == 'kbrd_full') ? ' selected' : '';
  echo '>Full keyboard</option>';
  echo '</select></p>';

  echo '<p><label for="loderikbrd_kbrd_language">';
  _e( 'Keyboard language', 'loderikbrd_textdomain' );
  echo '</label><br/>';
  echo '
    <select unselectable="on" id="loderikbrd_kbrd_language" name="loderikbrd_kbrd_language">' .
    _getLayoutSelectOptions() . '
    </select></p>
    <script type="text/javascript">
      jQuery("select#loderikbrd_kbrd_language").val("' . $language . '");
    </script>
  ';

  $skins = _getSkinsArray();
  $skin = get_post_meta( $post->ID, '_loderi_kbrd_skin', true );
  echo '<p><label for="loderikbrd_kbrd_skin">';
  _e( 'Keyboard skin', 'loderikbrd_textdomain' );
  echo '</label><br />';
  echo '<select id="loderikbrd_kbrd_skin" name="loderikbrd_kbrd_skin">';
  foreach ($skins as $value) {
    $selected = ($skin == $value) ? ' selected' : '';
    echo '<option value="' . $value . '" label="' . $value . '"' . $selected . '>' . $value . '</option>';
  }
  echo '</select></p>';
}

function loderikbrd_save_meta_box_data( $post_id ) {
  if ( ! isset( $_POST['loderikbrd_meta_box_nonce'] ) ) {
    return;
  }

  if ( ! wp_verify_nonce( $_POST['loderikbrd_meta_box_nonce'], 'loderikbrd_save_meta_box_data' ) ) {
    return;
  }

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }
  } else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  if ( !isset( $_POST['loderikbrd_kbrd_language'] ) ) {
    return;
  }

  $my_data1 = sanitize_text_field( $_POST['loderikbrd_kbrd_language'] );
  $my_data2 = sanitize_text_field( $_POST['loderikbrd_kbrd_enabled'] );
  $my_data3 = sanitize_text_field( $_POST['loderikbrd_kbrd_skin'] );
  $my_data4 = sanitize_text_field( $_POST['loderikbrd_kbrd_type'] );

  update_post_meta( $post_id, '_loderi_kbrd_language', $my_data1 );
  update_post_meta( $post_id, '_loderi_kbrd_enabled', $my_data2 );
  update_post_meta( $post_id, '_loderi_kbrd_skin', $my_data3 );
  update_post_meta( $post_id, '_loderi_kbrd_type', $my_data4 );
}
add_action( 'save_post', 'loderikbrd_save_meta_box_data' );

function modify_comment_field( $comment_field ){
  $kbrd = '';

  if ( get_post_meta( get_the_ID(), '_loderi_kbrd_enabled', true )
    && get_post_meta( get_the_ID(), '_loderi_kbrd_type', true ) == 'kbrd_full' ) {

    switch ( get_post_meta( get_the_ID(), '_loderi_kbrd_skin', true ) ) {
      case 'flat_gray':
        $style = 'margin-left: -25px;';
        break;

      default:
        $style = 'width: 445px;';
        break;
    }

    $kbrd = '
      <div style="width: 100%; margin-bottom: 1.23em">
        <div style="margin: 0 auto; ' . $style . '"><div id="kbrd" class="reset-styles"></div></div>
      </div>';
  }

  $comment_field = '<p class="comment-form-comment" style="margin-bottom: 0.4em">
  <label for="comment">' . _x( 'Comment', 'noun' ) . '</label>
  <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">
  </textarea>' . $kbrd . '</p>';

  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'modify_comment_field' );

function myjavascript_in_wp_head($pid){
  if ( is_single() OR is_page() ) {
    if ( get_post_meta( get_the_ID(), '_loderi_kbrd_enabled', true ) ) {
      echo '<style>.reset-styles{animation:none;animation-delay:0;animation-direction:normal;animation-duration:0;animation-fill-mode:none;animation-iteration-count:1;animation-name:none;animation-play-state:running;animation-timing-function:ease;backface-visibility:visible;background:0;background-attachment:scroll;background-clip:border-box;background-color:transparent;background-image:none;background-origin:padding-box;background-position:0 0;background-position-x:0;background-position-y:0;background-repeat:repeat;background-size:auto auto;border:0;border-style:none;border-width:medium;border-color:inherit;border-bottom:0;border-bottom-color:inherit;border-bottom-left-radius:0;border-bottom-right-radius:0;border-bottom-style:none;border-bottom-width:medium;border-collapse:separate;border-image:none;border-left:0;border-left-color:inherit;border-left-style:none;border-left-width:medium;border-radius:0;border-right:0;border-right-color:inherit;border-right-style:none;border-right-width:medium;border-spacing:0;border-top:0;border-top-color:inherit;border-top-left-radius:0;border-top-right-radius:0;border-top-style:none;border-top-width:medium;bottom:auto;box-shadow:none;box-sizing:content-box;caption-side:top;clear:none;clip:auto;color:inherit;columns:auto;column-count:auto;column-fill:balance;column-gap:normal;column-rule:medium none currentColor;column-rule-color:currentColor;column-rule-style:none;column-rule-width:none;column-span:1;column-width:auto;content:normal;counter-increment:none;counter-reset:none;cursor:auto;direction:ltr;display:inline;empty-cells:show;float:none;font:normal;font-family:inherit;font-size:medium;font-style:normal;font-variant:normal;font-weight:normal;height:auto;hyphens:none;left:auto;letter-spacing:normal;line-height:normal;list-style:none;list-style-image:none;list-style-position:outside;list-style-type:disc;margin:0;margin-bottom:0;margin-left:0;margin-right:0;margin-top:0;max-height:none;max-width:none;min-height:0;min-width:0;opacity:1;orphans:0;outline:0;outline-color:invert;outline-style:none;outline-width:medium;overflow:visible;overflow-x:visible;overflow-y:visible;padding:0;padding-bottom:0;padding-left:0;padding-right:0;padding-top:0;page-break-after:auto;page-break-before:auto;page-break-inside:auto;perspective:none;perspective-origin:50% 50%;position:static;right:auto;tab-size:8;table-layout:auto;text-align:inherit;text-align-last:auto;text-decoration:none;text-decoration-color:inherit;text-decoration-line:none;text-decoration-style:solid;text-indent:0;text-shadow:none;text-transform:none;top:auto;transform:none;transform-style:flat;transition:none;transition-delay:0s;transition-duration:0s;transition-property:none;transition-timing-function:ease;unicode-bidi:normal;vertical-align:baseline;visibility:visible;white-space:normal;widows:0;width:auto;word-spacing:normal;z-index:auto}</style>';
      if ( get_post_meta( get_the_ID(), '_loderi_kbrd_type', true ) == 'kbrd_widget' ) {
        echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';
        echo '
          <style>
            .kbrd-dialog .ui-dialog-title {
              font-size: 0.6em;
            }
            .kbrd-dialog .ui-dialog-titlebar {
              padding: 0.1em 0.4em;
            }
            .kbrd-dialog .ui-dialog-content {
              padding: .5em;
            }
          </style>';
        echo '<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
      }

      echo '<script
        type="text/javascript"
        src="' . plugin_dir_url( __FILE__ ) .
        'js/vk_loader.js' .
        '?vk_layout=' . get_post_meta( get_the_ID(), '_loderi_kbrd_language', true ) .
        '&vk_skin=' . get_post_meta( get_the_ID(), '_loderi_kbrd_skin', true ) .
        '"></script>';
    }
  }
}
add_action( 'wp_head', 'myjavascript_in_wp_head' );

function myjavascript_in_wp_footer($pid){
  if ( is_single() OR is_page() ) {
    if ( get_post_meta( get_the_ID(), '_loderi_kbrd_enabled', true )
      && get_post_meta( get_the_ID(), '_loderi_kbrd_type', true ) == 'kbrd_full' ) {
      $t = _getLangcodeAndLink( get_post_meta( get_the_ID(), '_loderi_kbrd_language', true ) );

      echo '
        <script type="text/javascript">
          EM.addEventListener(window,"domload",function(){
            VirtualKeyboard.toggle("comment", "kbrd");
            VirtualKeyboard.setVisibleLayoutCodes([\'' . $t[0] . '\']);
            jQuery("#virtualKeyboard #copyrights").html("Powered by <a href=\"http://loderi.com' . $t[1] . '\">Loderi.com</a>");
          });
        </script>';
    }
  }
}
add_action( 'wp_footer', 'myjavascript_in_wp_footer' );

class Kbrd_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'Kbrd_Widget', // Base ID
      __('Virtual Keyboard', 'loderikbrd_textdomain'), // Name
      array( 'description' => __( 'Virtual keyboard by Loderi.com', 'loderikbrd_textdomain' ), ) // Args
    );
  }

  public function widget( $args, $instance ) {
    if ( ( is_single() OR is_page() )
      && get_post_meta( get_the_ID(), '_loderi_kbrd_enabled', true ) ) {

      if ( get_post_meta( get_the_ID(), '_loderi_kbrd_type', true ) == 'kbrd_widget' ) {
        $t = _getLangcodeAndLink( get_post_meta( get_the_ID(), '_loderi_kbrd_language', true ) );
        $loderikbrd_kbrd_skin = get_post_meta( get_the_ID(), '_loderi_kbrd_skin', true );

        switch ($loderikbrd_kbrd_skin) {
          case 'air_small':
            $width = 470;
            break;

          case 'goldie':
            $width = 556;
            break;

          case 'small':
            $width = 303;
            break;

          case 'winxp':
            $width = 423;
            break;

          case 'textual':
            $width = 423;
            break;

          case 'flat_gray':
            $width = 685;
            break;

          default:
            $width = 470;
            break;
        }

        echo $args['before_widget'];
        echo '<script type="text/javascript">';
        echo '  jQuery(function() {
                  jQuery( "#kbrd_popup" ).dialog({
                    autoOpen: false,
                    dialogClass: "kbrd-dialog",
                    minWidth: ' . $width . ',
                    create: function( event, ui ) {
                      VirtualKeyboard.toggle("comment", "kbrd2");
                      VirtualKeyboard.setVisibleLayoutCodes([\'' . $t[0] . '\']);
                      jQuery("#kbrd2 #copyrights").html("Powered by <a href=\"http://loderi.com' . $t[1] . '\">Loderi.com</a>");
                      jQuery("input[type=text],input[type=email],input[type=url],input[type=password],textarea").live("focus", function(){
                        VirtualKeyboard.attachInput(this);
                        console.log("binded");
                      });
                    }
                  });
                });';
        echo '</script>';
        echo '<button href="#" onclick="jQuery( \'#kbrd_popup\' ).dialog( \'open\' ); return false;">';
        echo __( 'Virtual Keyboard', 'loderikbrd_textdomain' );
        echo '</button>';
        echo '<div id="kbrd_popup" style="display: none;" title="Virtual Keyboard"><div id="kbrd2" class="reset-styles"></div></div>';
        echo $args['after_widget'];
      }
    }
  }
}
add_action( 'widgets_init', function() {
  register_widget( 'Kbrd_Widget' );
});

function loderikbrd_load_textdomain() {
  load_plugin_textdomain( 'loderikbrd_textdomain', false, dirname( plugin_basename(__FILE__) ) . '/lang/' );
}
add_action('plugins_loaded', 'loderikbrd_load_textdomain');