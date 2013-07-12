var key = '';
$(document).ready(function() {
        TerminalShell.commands['artisan'] = function(terminal) {
                data = '';
                for (var i = 1; i < arguments.length; i++) {
                        data += ' ' + arguments[i];
                } 

                $.ajax({
                        type: "POST",
                        url: base_url+'run',
                        cache: false,
                        beforeSend: function ( xhr ) {
                                terminal.setWorking(true);
                        },
                        data: {
                                cmd: data,
                                _token: token
                        }
                }).done(function(msg) {
                        terminal.print($(msg));
                        terminal.setWorking(false);
                }).fail(function(jqXHR, textStatus) {
					terminal.setWorking(false);
                	if(debug) {
                		var response = jqXHR.responseText;
                		if(response.substr(0, 5) == "<span")
	                		response = response.substr(37);
                		var obj = $.parseJSON(response);
                		if(obj.error != null) {
							var answer = "Error ("+obj.error.type+"): "+obj.error.message+" in "+obj.error.file+" ("+obj.error.line+")";
						} else {
							var answer = reponse;
						}
						terminal.print(answer);
					} else {
						terminal.print(js_error);
					}
				});
        };
        TerminalShell.commands['password'] = function(terminal,pass) {
                $.ajax({
                        type: "POST",
                        url: base_url + 'password',
                        cache: false,
                        beforeSend: function () {
                                terminal.setWorking(true);
                        },
                        data: {
                                password: pass,
                                _token: token
                        }
                }).done(function(msg) {
                        terminal.print(msg);
                        terminal.setWorking(false);
                }).fail(function(jqXHR, textStatus) {
					terminal.setWorking(false);
                	if(debug) {
                		var response = jqXHR.responseText;
                		if(response.substr(0, 5) == "<span")
	                		response = response.substr(37);
                		var obj = $.parseJSON(response);
                		if(obj.error != null) {
							var answer = "Error ("+obj.error.type+"): "+obj.error.message+" in "+obj.error.file+" ("+obj.error.line+")";
						} else {
							var answer = reponse;
						}
						terminal.print(answer);
					} else {
						terminal.print(js_error);
					}
				});
        };        
});