<?php 
# @*************************************************************************@
# @ Software author: Mansur Altamirov (Mansur_TL)                           @
# @ Author_url 1: https://www.instagram.com/mansur_tl                       @
# @ Author_url 2: http://codecanyon.net/user/mansur_tl                      @
# @ Author E-mail: vayart.help@gmail.com                                    @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 2020 - 2021 ColibriSM. All rights reserved.               @
# @*************************************************************************@

if (not_empty($cl['is_logged'])) {
	require_once cl_full_path("apps/native/http/err404/content.php");
}

else if(empty($_COOKIE["vud_id"])) {
	require_once cl_full_path("apps/native/http/err404/content.php");
}

else{
	$vud_id  = fetch_or_get($_COOKIE["vud_id"], false);
	$vu_data = cl_db_get_item(T_ACC_VALIDS, array(
		"hash" => $vud_id
	));

	if (empty($vu_data)) {
		require_once cl_full_path("apps/native/http/err404/content.php");
	}
	else{
		$cl["page_title"] = cl_translate("Confirm registration");
		$cl["page_desc"]  = $cl["config"]["description"];
		$cl["page_kw"]    = $cl["config"]["keywords"];
		$cl["pn"]         = "confirm_reg";
		$cl["sbr"]        = true;
		$cl["sbl"]        = true;
		$cl["http_res"]   = cl_template("confirm_reg/content");
	}
}


