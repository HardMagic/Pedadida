<?php
###############################
## ResourceSpace
## Local Configuration Script
###############################

# All custom settings should be entered in this file.
# Options may be copied from config.default.php and configured here.

require_once(__DIR__.'/../../pedadida-config.php');

# MySQL database settings 
$mysql_server = $pedadida_database_host;
$mysql_username = $pedadida_database_username;
$mysql_password = $pedadida_database_password;
$mysql_db = $pedadida_database_name;


# Base URL of the installation
$baseurl = $pedadida_library_base;
$secure= $pedadida_library_secure; # Using HTTPS?

# Email settings
$email_from = $pedadida_email_notify;
$email_notify = $pedadida_email_notify;

$spider_password = $pedadida_key1;
$scramble_key = $pedadida_key2;

# Paths
$research_request = false;
$ftp_server = '';
$ftp_username = '';
$ftp_password = '';
$ftp_defaultfolder = '';
$use_resource_column_data = false;
$thumbs_display_fields = array(8,3);
$list_display_fields = array(8,3,12);
$sort_fields = array(12);


$imagemagick_path = $pedadida_imagemagick_path; 
$ffmpeg_path = $pedadida_ffmpeg_path; 
$exiftool_path= $pedadida_exiftool_path;
$antiword_path= $pedadida_antiword_path;
$ghostscript_path= $pedadida_ghostscript_path;

$defaultlanguage = $pedadida_language; 
$applicationname = $pedadida_library_name; 

$send_statistics=false;
$allow_password_change=false;
$suggest_threshold=2;
$minyear=2009; 

$collection_reorder_caption=true;

# FFMPEG - generation of alternative video file sizes/formats

$ffmpeg_alternatives[0]["name"]="OGG";
 $ffmpeg_alternatives[0]["filename"]="_ogg";
 $ffmpeg_alternatives[0]["extension"]="ogv";
 # $ffmpeg_alternatives[0]["params"]="-vcodec h264 -s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec mp3 -ac 2";
 # $ffmpeg_alternatives[0]["params"]="-vcodec libx264 -vpre ultrafast -crf 22 -s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec libmp3lame -ac 2 -threads 0";
 $ffmpeg_alternatives[0]["params"]="-acodec libvorbis -ab 128k -ar 44100 -vcodec libtheora -b 1000k -bt 1000k -r 25 -threads 0";
 # $ffmpeg_alternatives[0]["params"]="-vcodec libtheora";
 
 

 /*$ffmpeg_alternatives[0]["name"]="High Definition";
 $ffmpeg_alternatives[0]["filename"]="quicktime_h264";
 $ffmpeg_alternatives[0]["extension"]="mov";
 # $ffmpeg_alternatives[0]["params"]="-vcodec h264 -s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec mp3 -ac 2";
 # $ffmpeg_alternatives[0]["params"]="-vcodec libx264 -vpre ultrafast -crf 22 -s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec libmp3lame -ac 2 -threads 0";
 $ffmpeg_alternatives[0]["params"]="-vcodec libx264 -fpre /usr/local/share/ffmpeg/libx264-lossless_ultrafast.ffpreset -crf 22 -s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec libmp3lame -ac 2 -threads 0";
*/

 $ffmpeg_alternatives[1]["name"]="Flash";
 $ffmpeg_alternatives[1]["filename"]="flash";
 $ffmpeg_alternatives[1]["extension"]="FLV";
 # $ffmpeg_alternatives[1]["params"]="-s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec mp3 -ac 2";
 $ffmpeg_alternatives[1]["params"]="-s wvga -aspect 16:9 -b 2500k -deinterlace -ab 160k -acodec libmp3lame -ac 2 -ar 44100";

 $ffmpeg_alternatives[2]["name"]="Mobile Devices";
 $ffmpeg_alternatives[2]["filename"]="mobile";
 $ffmpeg_alternatives[2]["extension"]="mp4";
 # $ffmpeg_alternatives[2]["params"]="-acodec aac -ab 128kb -vcodec mpeg4 -b 1200kb -mbd 2 -flags +4mv+trell -aic 2 -cmp 2 -subcmp 2 -s 320x180";
 $ffmpeg_alternatives[2]["params"]="-acodec aac -ab 112k -vcodec mpeg4 -b 500k -mbd 2 -flags +mv4+aic -trellis 1 -cmp 2 -subcmp 2 -s 480x320 -strict experimental";
 #$ffmpeg_alternatives[2]["params"]="-vcodec libx264 -vpre slow";
 /*
 $ffmpeg_alternatives[3]["name"]="WebM";
 $ffmpeg_alternatives[3]["filename"]="webm";
 $ffmpeg_alternatives[3]["extension"]="webm";
 $ffmpeg_alternatives[3]["params"]="-threads 4 -f webm -aspect 16:9 -vcodec libvpx -deinterlace -g 120 -level 216 -profile 0 -qmax 42 -qmin 10 -rc_buf_aggressivity 0.95 -vb 2M -acodec libvorbis -aq 90 -ac 2";
*/


# To be able to run certain actions asyncronus (eg. preview transcoding), define the path to php:
 $php_path=$pedadida_php_path;

# Use qt-faststart to make mp4 previews start faster
 $qtfaststart_path="/usr/local/bin";
 $qtfaststart_extensions=array("mp4","m4v","mov","ogg");


$allow_account_request=false;

# Should the system allow users to request new passwords via the login screen?
$allow_password_reset=false;

# Display 'View New Material' link in the quick search bar (same as 'Recent')
$view_new_material=true;

$research_request=true;

# If this is set to more than one the user will be able to page through the PDF file.
 $pdf_pages=20;
 
# Use the themes page as the home page?
$use_theme_as_home=false;

# Use the recent page as the home page?
$use_recent_as_home=true;

# Require terms on first login?
$terms_login=false;

$prefix_filename_string="ped_";

# Display the download as a 'save as' link instead of redirecting the browser to the download (which sometimes causes a security warning).
# For the Opera and Internet Explorer 7 browsers this will always be enabled regardless of the below setting as these browsers block automatic downloads by default.
$save_as=false;

$ffmpeg_preview=true; 
$ffmpeg_preview_seconds=120; # how many seconds to preview 
$ffmpeg_preview_extension="flv"; 
$ffmpeg_preview_min_width=32; 
$ffmpeg_preview_min_height=18; 
$ffmpeg_preview_max_width=640; 
$ffmpeg_preview_max_height=320; 
$ffmpeg_preview_options="-f flv -ar 22050 -b 650k -ab 32 -ac 1"; 

 $watermark="gfx/watermark.png";

# Show the contact us link?
$contact_link=false;

# Show the about us link?
$about_link=false;

$user_rating=true;

# Display User Rating Stars in search views (a popularity column in list view)
$display_user_rating_stars=true;
# Allow each user only one rating per resource (can be edited). Note this will remove all accumlated ratings/weighting on newly rated items.
$user_rating_only_once=true;
# if user_rating_only_once, allow a log view of user's ratings (link is in the rating count on the View page):
$user_rating_stats=true;

$php_time_limit=1000;

# Sets the default colour theme (defaults to white)
$defaulttheme="Pedadida";

# Theme chips available. This makes it possible to add new themes and chips using the same structure.
# To create a new theme, you need a chip in gfx/interface, a graphics folder called gfx/<themename>,
# and a css file called css/Col-<themename>.css
# this is a basic way of adding general custom themes that do not affect SVN checkouts, 
# though css can also be added in plugins as usual.
 
$available_themes=array("Pedadida","greyblu","black");

# Allow to change the location of the upload folder, so that it is not in the
# web visible path. Relative and abolute paths are allowed.
$local_ftp_upload_folder =  $pedadida_library_upload_folder;


# JUpload Chunk Size (bytes)
# The size in bytes that Jupload (Java Batch Upload) will break files into.
# JUpload chunking completely bypasses PHP's file upload limits (if chunk size is set lower than the upload limit).
$jupload_chunk_size="10000000"; # Chunk size ~5MB.

# JUpload Look and Feel
# set to "java" for java style file browser, and "system" to use look and feel of local system
$jupload_look_and_feel = "system";

$allow_resource_deletion = false;

# If collections have at least one video, enable multi-playback in the Video Playlist page. 
$video_playlists=true;

# Zip command to use to create zip archive 
$zipcommand="zip -j";

$anonymous_login="guest"; 