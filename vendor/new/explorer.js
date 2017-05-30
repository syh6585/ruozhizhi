/**
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
(function() {
  "use strict";

  // The chunk size of tailing the files, i.e., how many bytes will be shown
  // in the preview.
  var TAIL_CHUNK_SIZE = 32768;

  var current_directory = "";

  function show_err_msg(msg) {
    $('#alert-panel-body').html(msg);
    $('#alert-panel').show();
  }

  $(window).bind('hashchange', function () {
    $('#alert-panel').hide();

    var dir = window.location.hash.slice(1);
    if(dir == "") {
      dir = "/";
    }
    if(current_directory != dir) {
      browse_directory(dir);
    }
  });
  function append_path(prefix, s) {
    var l = prefix.length;
    var p = l > 0 && prefix[l - 1] == '/' ? prefix.substring(0, l - 1) : prefix;
    return p + '/' + s;
  }

  function get_response(data, type) {
    return data[type] !== undefined ? data[type] : null;
  }

  function get_response_err_msg(data) {
    return data.RemoteException !== undefined ? data.RemoteException.message : "";
  }

  function encode_path(abs_path) {
    abs_path = encodeURIComponent(abs_path);
    var re = /%2F/g;
//alert(abs_path);
    return abs_path.replace(re, '/');
  }

/*  function view_file_details(path, abs_path) {
    function show_block_info(blocks) {
      var menus = $('#file-info-blockinfo-list');
      menus.empty();

      menus.data("blocks", blocks);
      menus.change(function() {
        var d = $(this).data('blocks')[$(this).val()];
        if (d === undefined) {
          return;
        }

        dust.render('block-info', d, function(err, out) {
          $('#file-info-blockinfo-body').html(out);
        });

      });
      for (var i = 0; i < blocks.length; ++i) {
        var item = $('<option value="' + i + '">Block ' + i + '</option>');
        menus.append(item);
      }
      menus.change();
    }

    abs_path = encode_path(abs_path);
    var url = 'http://114.212.189.79:50070/webhdfs/v1' + abs_path + '?op=GET_BLOCK_LOCATIONS';
//alert(url);****************************************************************************
		   createXmlHttpRequestObject();
           var url1 = "test.php?type="+url; //待发送URL
           xmlHttp.onreadystatechange=ajaxok; // 判断浏览器状态栏 (接收玩数据触发的事件)
           xmlHttp.open("GET",url1,true); // GET向服务器端发送数据
           xmlHttp.send(null);
           // 开始提交数据
         // 回调函数 用于接收服务器返回过来的数据
       
        function ajaxok()
        {
           if(xmlHttp.readyState == 4 && xmlHttp.status==200)
           {
                // 表示数据已接收完成
           		var dat=xmlHttp.responseText;
		var data = eval("("+dat+")"); 
//******************************************************************
//    $.get(url).done(function(data) {
      var d = get_response(data, "LocatedBlocks");
      if (d === null) {
        show_err_msg(get_response_err_msg(data));
        return;
      }

      $('#file-info-tail').hide();
      $('#file-info-title').text("File information - " + path);

      var download_url = 'http://114.212.189.79:50070/webhdfs/v1' + abs_path + '?op=OPEN';

      $('#file-info-download').attr('href', download_url);
 /*     $('#file-info-preview').click(function() {
        var offset = d.fileLength - TAIL_CHUNK_SIZE;
        var url = offset > 0 ? download_url + '&offset=' + offset : download_url;
        $.get(url, function(t) {
          $('#file-info-preview-body').val(t);
          $('#file-info-tail').show();
        }, "text").error(network_error_handler(url));
      });

      if (d.fileLength > 0) {
        show_block_info(d.locatedBlocks);
        $('#file-info-blockinfo-panel').show();
      } else {
        $('#file-info-blockinfo-panel').hide();
      }
      $('#file-info').modal();
		   }}
//    }).error(network_error_handler(url));
  }*/
     var xmlHttp;
     function createXmlHttpRequestObject(){
         
        if(window.ActiveXobject){ // 判断是否是ie浏览器
          try { // try开始 
              xmlhttp = new ActiveXobject("Microsoft.XMLHTTP"); // 使用ActiveX对象创建ajax
           }catch(e){
               xmlHttp = false;
            } // try end
       }else{   //Chrome、FireFox等非ie内核
           try{
            xmlHttp = new XMLHttpRequest(); //视为非ie情况下
           }catch(e){
              xmlHttp = false; // 其他非主流浏览器
          }
        } // 判断结束,如果创建成功则返回一个DOM对象,如果创建不成功则返回一个false
               
            if(xmlHttp)
            {
                return xmlHttp;
            }else{
                alert("对象创建失败,请检查浏览器是否支持XmlHttpRequest!");
            }
        
     } // 函数体
	var bkwd,fwd;
  function browse_directory(dir) {
    var HELPERS = {
      'helper_date_tostring' : function (chunk, ctx, bodies, params) {
        var value = dust.helpers.tap(params.value, chunk, ctx);
        return chunk.write('' + new Date(Number(value)).toLocaleString());
      }
    };
//alert(dir);
    var url = 'http://114.212.189.79:50070/webhdfs/v1' + encode_path(dir) + '?op=LISTSTATUS';
//alert(url);****************************************************************************
		   createXmlHttpRequestObject();
           var url1 = "test.php?type="+url; //待发送URL
           xmlHttp.onreadystatechange=ajaxok; // 判断浏览器状态栏 (接收玩数据触发的事件)
           xmlHttp.open("GET",url1,true); // GET向服务器端发送数据
           xmlHttp.send(null);
           // 开始提交数据
         // 回调函数 用于接收服务器返回过来的数据
       
        function ajaxok()
        {
           if(xmlHttp.readyState == 4 && xmlHttp.status==200)
           {
                // 表示数据已接收完成
           		var dat=xmlHttp.responseText;
			  // console.log(dat);
		var data = eval("("+dat+")"); 
//******************************************************************
 //   $.get(url, function(data) {
      var d = get_response(data, "FileStatuses");
      if (d === null) {
        show_err_msg(get_response_err_msg(data));
        return;
      }
			
/*	var re = new RegExp(/^part-([a-z]-)?\d{5}/);
	var files=d.FileStatus;
	for(var i=0;i< files.length;i++){
		var cur_file=files[i];
		//alert(cur_file.pathSuffix+" "+cur_file.pathSuffix.substring(0,5));
		if(cur_file.type=="FILE"){
			
			//alert(cur_file.pathSuffix);
		   	//	$('#newtext').val(dir);
			//$('#newModal').modal('hide');
			return;
		   }
	}*/
//alert(d);
			   current_directory = dir;
      
			
      $('#directory').val(dir);
      window.location.hash = dir;
      var base = dust.makeBase(HELPERS);
      dust.render('explorer', base.push(d), function(err, out) {
        $('#panel').html(out);
		var files=d.FileStatus;
		  var table = document.getElementById("tab");
		  for(var i=0;i< files.length;i++){
		var cur_file=files[i];
		if(cur_file.type=="FILE"){
			table.rows[i+1].style.backgroundColor= 'AliceBlue';
		   }
		  }
        $('.explorer-browse-links').click(function() {
          var type = $(this).attr('inode-type');
          var path = $(this).attr('inode-path');
          var abs_path = append_path(current_directory, path);
          if (type == 'DIRECTORY') {
			  bkwd=current_directory;
            browse_directory(abs_path);
          } else {
			$('#arg5').val(abs_path);
			$('#newModal').modal('hide');
			//	  console.log($('#newtext'));
         //   view_file_details(path, abs_path);
          }
        });
		  $('.browse-file-new').dblclick(function(){
					var type = $(this).attr('inode-type');
          var path = $(this).attr('inode-path');
          var abs_path = append_path(current_directory, path);
          if (type == 'DIRECTORY') {
			  bkwd=current_directory;
            browse_directory(abs_path);
          } else {
			$('#arg5').val(abs_path);
			$('#newModal').modal('hide');
			//	  console.log($('#newtext'));
         //   view_file_details(path, abs_path);
          }				  
			});
      });
			             }
		}
//    }).error(network_error_handler(url));
  }


  function init() {
    dust.loadSource(dust.compile($('#tmpl-explorer').html(), 'explorer'));
    dust.loadSource(dust.compile($('#tmpl-block-info').html(), 'block-info'));
	  $('#newModal').modal({backdrop: 'static'});
	  $('#newModal').modal('hide');
    var b = function() { browse_directory($('#directory').val()); };
    $('#btn-nav-directory').click(b);
	  var b1=function() {$('#arg5').val(current_directory);$('#newModal').modal('hide'); };
	 $('#choosedir').click(b1);
	  var b2=function() { browse_directory(fwd); };
	// $('#fwd').click(b2);
	  var b3=function(){
	  	var tmpstr=current_directory;
		  if(tmpstr=="/") return;
		  var tmp=current_directory.lastIndexOf('/');
		  if(tmp==0) browse_directory("/");else
		 browse_directory(tmpstr.substring(0,tmp));
	  };
	  $('#uwd').click(b3);
    var dir = window.location.hash.slice(1);
	  bkwd=dir;fwd=dir;
	 
    if(dir == "") {
      window.location.hash = "/";
    } else {
      browse_directory(dir);
    }
  }

  init();
})();
