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

if (empty($cl["is_logged"])) {
	cl_redirect("guest");
}

$transfer_sid = fetch_or_get($_GET["sid"], false);

$bank_trans_session = cl_session("bank_trans_session");

if ($cl["config"]["bank_method_status"] != "on" || empty($transfer_sid) || empty($bank_trans_session) || $bank_trans_session["sess_id"] != $transfer_sid) {
	require_once cl_full_path("apps/native/http/err404/content.php");
}

else {
	$cl["page_title"] = cl_translate("Bank transfer");
	$cl["page_desc"]  = $cl["config"]["description"];
	$cl["page_kw"]    = $cl["config"]["keywords"];
	$cl["pn"]         = "wallet_banktrans";
	$cl["sbr"]        = true;
	$cl["sbl"]        = true;
	$cl["http_res"]   = cl_template("wallet_banktrans/content");
}