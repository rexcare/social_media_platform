<?php 
# @*************************************************************************@
# @ Software author: Mansur Altamirov (Mansur_TL)							@
# @ Author_url 1: https://www.instagram.com/mansur_tl                       @
# @ Author_url 2: http://codecanyon.net/user/mansur_tl                      @
# @ Author E-mail: vayart.help@gmail.com                                    @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 2020 - 2021 ColibriSM. All rights reserved.               @
# @*************************************************************************@

function cl_get_guest_feed($offset = false, $limit = 10) {
	global $db, $cl;

	$data        = array();
	$sql         = cl_sqltepmlate("apps/feed/sql/fetch_feed", array(
		"t_pubs" => T_PUBS,
		"offset" => $offset,
		"limit"  => $limit
 	));

	$query_res = $db->rawQuery($sql);
    $counter   = 0;

	if (cl_queryset($query_res)) {
		foreach ($query_res as $row) {
			$data[] = cl_post_data($row);

            if ($cl['config']['advertising_system'] == 'on') {
                if (cl_is_feed_nad_allowed()) {
                    if (not_empty($offset)) {
                        if ($counter == 5) {
                            $counter = 0;
                            $ad      = cl_get_timeline_ads();

                            if (not_empty($ad)) {
                                $data[] = $ad;
                            }
                        }
                        else {
                            $counter += 1;
                        }
                    }
                }
            }
		}

        if ($cl['config']['advertising_system'] == 'on') {
            if (cl_is_feed_nad_allowed()) {
                if (empty($offset)) {
                    $ad = cl_get_timeline_ads();

                    if (not_empty($ad)) {
                        $data[] = $ad;
                    }
                }
            }
        }
	}

	return $data;
}