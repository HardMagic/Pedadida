{"filter":false,"title":"resourcespace.php","tooltip":"/wp-content/plugins/pedadida_main/register/bridges/resourcespace.php","undoManager":{"mark":11,"position":11,"stack":[[{"group":"doc","deltas":[{"action":"removeLines","range":{"start":{"row":3,"column":0},"end":{"row":14,"column":0}},"nl":"\r\n","lines":["Variables to be used","","$user_id = ID","$info->user_login = User Name","$info->user_pass = User Password","$info->user_email = Email","$info->first_name = First Name","$info->last_name = Last Name","","","Info needed to add is at bottom."]}]}],[{"group":"doc","deltas":[{"action":"removeLines","range":{"start":{"row":3,"column":0},"end":{"row":4,"column":0}},"nl":"\r\n","lines":[""]}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":7,"column":0},"end":{"row":7,"column":61}},"text":"if(mysql_num_rows(mysql_query(\"SHOW TABLES LIKE 'user'\"))==1)"},{"action":"insertText","range":{"start":{"row":7,"column":0},"end":{"row":7,"column":65}},"text":"if($wpdb->get_var(\"SHOW TABLES LIKE 'mdl_users'\") == 'mdl_users')"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":7,"column":37},"end":{"row":7,"column":46}},"text":"mdl_users"},{"action":"insertText","range":{"start":{"row":7,"column":37},"end":{"row":7,"column":38}},"text":"u"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":38},"end":{"row":7,"column":39}},"text":"s"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":39},"end":{"row":7,"column":40}},"text":"e"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":40},"end":{"row":7,"column":41}},"text":"r"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":7,"column":37},"end":{"row":7,"column":41}},"text":"user"},{"action":"insertText","range":{"start":{"row":7,"column":37},"end":{"row":7,"column":41}},"text":"user"}]}],[{"group":"doc","deltas":[{"action":"removeText","range":{"start":{"row":7,"column":49},"end":{"row":7,"column":58}},"text":"mdl_users"},{"action":"insertText","range":{"start":{"row":7,"column":49},"end":{"row":7,"column":50}},"text":"u"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":50},"end":{"row":7,"column":51}},"text":"s"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":51},"end":{"row":7,"column":52}},"text":"e"}]}],[{"group":"doc","deltas":[{"action":"insertText","range":{"start":{"row":7,"column":52},"end":{"row":7,"column":53}},"text":"r"}]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":7,"column":0},"end":{"row":7,"column":56},"isBackwards":true},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1408230413758,"hash":"202448dd8e76f8a95cbf19127d946011c063d3de"}