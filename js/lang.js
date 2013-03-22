function langue_select(lang_texte)
{
	$.get("include/lang/choose_lang.php", { lang: lang_texte } );
	location.reload();
}