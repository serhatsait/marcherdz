<?
header("Content-type: text/css");
include '../../functions.php';
echo '
body {
	font-family: Arial, Helvetica, sans-serif;
	background-color: #f9f9f9;
}
body, td, th {
	font-family: Arial, Helvetica, sans-serif
}
.navbar-default {
	background-image: none !important;
	background-color: #fff !important;
	border-bottom: none !important;
	margin-bottom: 0px !important;
	border-bottom: solid 5px #912da2;
	-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0);
	-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0);
	box-shadow: 10px 10px 5px 0px rgba(0,0,0,0);
}
.navbar {
	min-height: 100px;
	margin-bottom: 0px !important
}
.bannerc {
	width:100%;
	margin-left:auto;
	margin-right:auto;
	text-align:center;
	margin-bottom:20px;
}
.panel ul {
	padding: 0px;
	margin: 0px;
	list-style: none;
}
.news-item {
	padding: 4px 4px;
	margin: 0px;
	border-bottom: 1px dotted #555;
}
#search_form {
	margin-top: 0px !important;
	padding-top: 0px !important
}
.navbar navbar-right {
	padding-right: 0px !important
}
.srx {
	width: 260px !important;
	-webkit-border-top-left-radius: 4px !important;
	-webkit-border-bottom-left-radius: 4px !important;
	-moz-border-radius-topleft: 4px !important;
	-moz-border-radius-bottomleft: 4px !important;
	border-top-left-radius: 4px !important;
	border-bottom-left-radius: 4px !important;
	font-size: 12px
}
.pos {
	position: relative;
	height: 220px;
}
.top {
	background-color: #474747;
	color: #fff;
	line-height: 35px;
	border-top:solid 5px '.$renk.'
}
.top i {
	font-size:16px !important
}
.btn-social-icon {
	height:25px !important;
	widows:25px !important
}
.btn-social-icon>:first-child {
	line-height:25px
}
.panel-title a {
	text-decoration:none
}
.linkt {
	text-decoration: underline !important
}
.pos button {
	position: absolute;
	bottom: 0px;
}
.media-middle img {
	width: 64px !important;
	height: 64px !important;
	padding: 5px;
	border: solid 0px #d8d8d8;
}
.media-heading {
	font-weight: normal !important;
	font-size: 14px !important;
}
.collapse {
	margin-top: 13px !important
}
.table-striped th {
	font-size: 12px !important;
	border-bottom: none !important;
	padding: 0px !important;
	background-color: '.$renk.' !important;
	padding: 10px !important;
	border-right: solid 1px #fff !important;
	color: #fff !important;
	box-shadow: 0 1px 0 rgba(255, 255, 255, 0.15) inset, 0 1px 1px rgba(0, 0, 0, 0.075) !important;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2) !important;
}
.nav-pills a {
	color: #666 !important
}
.liste a {
	color: '.$renk.' !important;
	font-size: 18px
}
.activex a {
	background-color: '.$renk.' !important;
	color: #fff !important;
}
.table-striped tr {
	border-top: none !important;
	cursor: pointer
}
.center {
	text-align: center !important
}
.fiyat {
	color: #900 !important
}
.table-striped td {
	font-size: 12px !important;
	vertical-align: middle !important;
	border-bottom: dotted 1px #eee !important;
	border-top: none !important;
	padding: 10px;
	height: 90px;
	border-right: solid 1px #fff !important
}
.table-striped td img {
	border: solid 1px #eee;
	padding: 5px;
	background-color: #fff
}
.gri {
	background-color: #474747 !important
}

.navbar-right .dropdown-menu {
	left: auto;
	padding: 0;
	right: 0;
}
.turuncu {
	background-color: '.$renk.' !important;
	border-color: '.$renk.' !important;
	color: #fff !important
}
.ga {
	padding-left: 10px
}
.navbar-toggle {
	margin-top: 15px !important
}
.breadcr {
	background: url(../img/bg.jpg);
	background-position: bottom center;
	line-height: 50px;
	color: #fff;
	font-size: 18px
}
.breadcr i {
	font-size: 14px
}
.search {
	background: url(../img/bg.jpg);
	height: 125px;
	background-position: bottom center
}
.search h2 {
	color: #fff !important;
	font-size: 22px !important;
	margin-bottom: 20px;
}
.search h3 {
	color: #fff !important;
	font-size: 16px !important;
	margin-bottom: 15px;
	font-weight: bold !important
}
.search-box {
	background-color: #fff;
	height: 60px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	border-right: solid 1px '.$renk.'
}
.datayli-arama {
	line-height: 60px !important;
	float: none !important;
	z-index: 1;
	padding-left: 10px
}
.datayli-arama a {
	color: #fff !important;
	text-decoration: underline;
	font-size: 18px;
}
.search-box input {
	height: 60px !important;
	border: none !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.search-box button {
	height: 60px !important;
	border: solid 5px '.$renk.' !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.search-box select {
	height: 60px !important;
	border: none !important;
	-webkit-border-top-left-radius: 4px !important;
	-webkit-border-bottom-left-radius: 4px !important;
	-moz-border-radius-topleft: 4px !important;
	-moz-border-radius-bottomleft: 4px !important;
	border-top-left-radius: 4px !important;
	border-bottom-left-radius: 4px !important;
	-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	z-index: 999
}
.btn-siyah {
	background-color: '.$renk.';
	color: #fff;
	font-weight: 400;
	font-size: 18px;
	border: none !important;
	-webkit-border-top-right-radius: 4px !important;
	-webkit-border-bottom-right-radius: 4px !important;
	-moz-border-radius-topright: 4px !important;
	-moz-border-radius-bottomright: 4px !important;
	border-top-right-radius: 4px !important;
	border-bottom-right-radius: 4px !important;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2) !important;
}
.btn-warning {
	background-color: '.$renk.' !important;
	border-color: '.$renk.' !important
}
.btn-siyah:hover {
	color: #fff;
	text-decoration: underline
}
.thumbnails {
	margin: 0 !important;
	padding: 0 !important;
	list-style-type: none !important;
	border: none !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.thumbnail {
	border: none !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
	-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	margin-bottom: 10px !important;
}
.thumbnail img {
	margin: auto;
	border: none !important;
	padding: 0px !important
}
#firsat .span3 {
	width: 24.9% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 250px
}
#firsat .span3 a {
}
#firsat .span3:last-child {
	border-right: solid 0px #eee;
}
#firsat .span3 img {
	height: 125px !important;
	width: auto !important
}
.span3 {
	width: 14.2% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 125px
}
.span3:last-child {
	border: none !important
}
.span3 img {
	height: 75px !important;
	width: auto !important
}
.slide {
	background-color: #FFF !important;
	border: solid 1px #eee;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.none {
	border: none !important
}
.caption {
	padding-left: 10px;
	text-align: center;
	margin: 0 !important
}
.nn a {
	color: #fff !important;
	font-size: 30px !important
}
.nn {
	text-align: right !important
}
.main {
	margin-top: 15px;
	min-height:350px
}
.kategoriler {
	margin: 0;
	padding: 0;
	list-style-type: none;
	max-height: 400px;
	overflow: auto
}
.kategoriler li {
	font-size: 10px;
	color: #999;
	line-height: 20px;
	margin-top: 10px
}
.kategoriler li a {
	font-size: 13px;
	font-weight: 600;
	color: #000
}
.kategoriler2 {
	margin: 0;
	padding: 0;
	list-style-type: none
}
.kategoriler2 li {
	padding-left: 10px;
	margin-top: 0px
}
.kategoriler2 li a {
	font-weight: 400;
}
.ilanlar {
	margin: 0;
	padding: 0;
	list-style-type: none
}
.ilanlar li {
	float: left;
	margin-right: 6.5px;
	width: 110px;
	margin-top: 5px;
	height: 120px;
	border: solid 1px #eee;
	padding: 5px;
	text-align: center;
	position: relative;
	font-size: 11px
}
.ilanlar li a {
	text-decoration: none
}
.ilanbaslik {
	margin-top: 5px;
	text-transform: capitalize;
}
.title {
	font-size: 16px;
	font-weight: bold;
	margin: 0;
	padding: 0;
	border-bottom: solid 1px #eee;
	padding-bottom: 10px;
	font-weight: 600;
	margin-top: 10px
}
.title a {
	font-size: 12px;
	color: #000 !important
}
ilanlar2 {
	margin: 0 !important;
	padding: 0 !important;
	list-style-type: none;
	width: 100%
}
.ilanlar2 li {
	list-style-type: none;
	list-type: none;
	float: left;
	width: 50% !important;
	;
	margin-top: 5px;
	height: 110px;
	border: solid 1px #eee;
	padding: 5px;
	position: relative;
	font-size: 11px;
	margin: 0px !important;
	padding: 0px!important;
}
.panel-heading {
	background: none !important;
	border: none !important;
}
.panel-body {
	margin: 0 !important;
	padding-top: 0 !important
}
.panel-default {
	border: solid 1px #eee !important
}
.resimbox2 {
	width: 120px;
	float: left
}
.resimbox2 img {
	height: 70px !important;
	width: auto !important;
	max-width: 100px !important
}
.resimbox img {
	height: 70px !important;
	width: auto !important;
	max-width: 100px !important
}
.gr {
	font-weight: bold !important;
	color: #000 !important
}
.badge {
	background-color: #fff !important;
	color: #000 !important
}
.ilan2>div {
	border: solid 1px #eee;
	margin-top: 10px;
	padding: 10px;
	height: 140px;
	font-size: 12px
}
.resimbox3 {
	width: 30%;
	float: left;
	border: solid 1px #eee;
	padding: 5px;
	text-align: center
}
.resimbox3 img {
	width: auto;
	height: 75px;
	max-width: 100px !important;
}
.icerik {
	float: right;
	width: 65%;
}
.ilanno {
	color: #666;
	font-size: 12px
}
.icerik a {
	font-size: 12px
}
.fiyat {
	color: red
}

#scrollbox3 {
	overflow: auto;
	width: 400px;
	height: 800px;
	padding: 0 5px;
	border: 1px solid #b7b7b7;
}
.track3 {
	width: 10px;
	background: rgba(0, 0, 0, 0);
	margin-right: 2px;
	border-radius: 10px;
	-webkit-transition: background 250ms linear;
	transition: background 250ms linear;
}
.track3:hover, .track3.dragging {
	background: #d9d9d9;
	background: rgba(0, 0, 0, 0.15);
}
.handle3 {
	width: 7px;
	right: 0;
	background: #999;
	background: rgba(0, 0, 0, 0.4);
	border-radius: 7px;
	-webkit-transition: width 250ms;
	transition: width 250ms;
}
.track3:hover .handle3, .track3.dragging .handle3 {
	width: 10px;
}
.mres {
	text-align: center;
	border-bottom: none;
	width: 100% !important;
	height: auto !important;
	max-height: 340px;
	max-width: 100%;
	min-height: 340px;
	margin-bottom:10px !important
}
.mres img {
    max-height: 320px !important;
    vertical-align: middle;
    height: auto !important;
    max-width: 420px !important;
}
.mres2 {
	text-align: center;
	padding: 5px;
	border: solid 1px #eee;
	margin-top: 5px;
}
.thumbs {
	margin-top: 0px;
}
.mega {
	padding: 10px;
	border: solid 1px #eee;
}
.mega a {
	font-size: 12px;
	font-weight: bold
}
.thumbnail img {
	height: 75px !important;
}
.padpad {
	padding: 6px;
	padding-left: 0px;
	margin-top: 0px
}
.fiyat2 {
	font-size: 16px;
	font-weight: bold;
	padding-bottom: 5px
}
.ililce {
	font-size: 12px;
	color: #060;
	padding-bottom: 5px
}
.kalin {
	font-weight: bold
}
.altcizgi {
	padding-bottom: 5px;
	padding-top: 5px;
	font-size: 13px;
	font-family: Arial, Helvetica, sans-serif
}
.gutter {
	padding: 0px;
	margin: 0px
}
.kirmizi {
	color: red
}
.kirmizi_ikon {
	color: #999
}
.kirmizi_ikon i {
	color: #999
}
.yesil_ikon i {
	color: green
}
.bkirmizi {
	background-color: #900;
	border-color: #900
}
.bkirmizi:hover {
	background-color: #900
}
.gri {
	background-color: #474747 !important;
	border-color: #474747 !important
}
.gri:hover {
	background-color: #C80003;
	border-color: #C80003
}
.bleft {
	text-align: left !important
}
.bilgi {
	border: solid 1px #eee;
	padding: 5px;
	margin-top:10px;
}
.bilgi2 {
	background-color: #fff;
	padding-top: 0px;
	padding-right: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
}
.bilgi2 h4 {
	font-size: 14px;
	font-weight: bold
}
.utarih {
	font-size: 12px;
	margin-bottom: 10px;
	padding-bottom: 5px
}
.ulink {
	font-size: 12px;
	padding-top: 5px;
}
.ulink a {
	text-align: left !important
}
.xx {
	border-bottom: solid 1px #eee;
	padding-left: 0px;
	margin-left: 0px;
	padding-right: 0px;
	margin-right: 0px
}
.xx div {
	margin-left: 0px;
	padding-left: 0px;
}
.telefon {
	border: solid 1px #d8d8d8;
	background-color: #fff;
	padding: 10px;
	padding-bottom: 6px;
	margin-top: 5px;
	font-size: 14px;
}
.telefon label {
	width: 25px
}
.modal-wide .modal-dialog {
	width: 80%;
}
.thumbnail {
	margin: 0px !important;
	padding: 0px !important;
	padding: 5px !important;
	border: solid 1px #eee !important
}
.ozellik {
	padding-top: 5px;
	padding-bottom: 5px
}
.panel-body {
	word-wrap: break-word !important
}
.span3.thumbnail {
	border: none !important
}
@media (min-width: 992px) and (max-width: 1199px) {
.ilanlar li {
	float: left;
	margin-right: 1%;
	width: 24%;
	margin-top: 5px;
	height: 115px;
	border: solid 1px #eee;
	padding: 8px;
	text-align: center;
	position: relative;
	font-size: 11px
}
.search {
	background: url(../img/bg.jpg);
	height: 150px;
	background-position: top right
}
}
 @media (min-width: 768px) and (max-width: 991px) {
.search {
	background: url(../img/bg.jpg);
	height: 500px;
	background-position: top right
}
.ilanlar li {
	float: left;
	margin-right: 1%;
	width: 24%;
	margin-top: 5px;
	height: 110px;
	border: solid 1px #eee;
	padding: 10px;
	text-align: center;
	position: relative;
	font-size: 11px
}
.pos {
	position: relative;
	height: 70px;
}
.main {
	margin-top: 10px
}
.navbar-brand img {
	width: auto !important;
	height: 40px !important;
	margin-top: 0px
}
.search h2 {
	color: #fff !important;
	font-size: 22px !important;
	margin-bottom: 30px;
}
.search h3 {
	color: #fff !important;
	font-size: 16px !important;
	margin-bottom: 15px;
	font-weight: bold !important
}
.search-box {
	background-color: #fff;
	height: 40px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}
.datayli-arama {
	line-height: 50px !important;
	float: none !important;
	z-index: 1;
	padding-left: 0px
}
.datayli-arama a {
	color: #fff !important;
	text-decoration: underline;
	font-size: 18px;
}
.search-box input {
	height: 40px !important;
	border: none !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.search-box button {
	height: 40px !important;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	border: none
}
.search-box select {
	height: 40px !important;
	border: none !important;
	-webkit-border-top-left-radius: 4px !important;
	-webkit-border-bottom-left-radius: 4px !important;
	-moz-border-radius-topleft: 4px !important;
	-moz-border-radius-bottomleft: 4px !important;
	border-top-left-radius: 4px !important;
	border-bottom-left-radius: 4px !important;
	-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
}
.search h2 {
	color: #fff !important;
	font-size: 22px !important;
	margin-bottom: 10px;
}
.search h3 {
	color: #000 !important;
	font-size: 16px !important;
	font-weight: bold !important
}
.search {
	background: url(../img/bg.jpg);
	height: 270px;
	background-position: top right
}
.nn {
	display: none
}
#myCarousel {
	display: none
}
#firsat .span3 {
	width: 33% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 250px !important
}
#firsat .span3:last-child {
	display: none
}
}
 @media (max-width: 767px) {
.ilanlar li {
	float: left;
	margin-right: 1%;
	width: 32%;
	margin-top: 5px;
	height: 110px;
	border: solid 1px #eee;
	padding: 10px;
	text-align: center;
	position: relative;
	font-size: 11px
}
.pos {
	position: relative;
	height: 70px;
}
#firsat .span3 {
	width: 25% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 200px
}
.main {
	margin-top: 10px
}
.navbar-brand img {
	width: auto !important;
	height: 40px !important;
	margin-top: 0px
}
.search h2 {
	color: #fff !important;
	font-size: 22px !important;
	margin-bottom: 30px;
}
.search h3 {
	color: #fff !important;
	font-size: 16px !important;
	margin-bottom: 15px;
	font-weight: bold !important
}
.search-box {
	background-color: #fff;
	height: 40px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
}
.datayli-arama {
	line-height: 40px !important;
	float: none !important;
	z-index: 1;
	padding-left: 0px
}
.datayli-arama a {
	color: #fff !important;
	text-decoration: underline;
	font-size: 18px;
}
.search-box input {
	height: 40px !important;
	border: none !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.search-box button {
	height: 40px !important;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	border: none
}
.search-box select {
	height: 40px !important;
	border: none !important;
	-webkit-border-top-left-radius: 4px !important;
	-webkit-border-bottom-left-radius: 4px !important;
	-moz-border-radius-topleft: 4px !important;
	-moz-border-radius-bottomleft: 4px !important;
	border-top-left-radius: 4px !important;
	border-bottom-left-radius: 4px !important;
	-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
}
.search h2 {
	color: #fff !important;
	font-size: 22px !important;
	margin-bottom: 10px;
}
.search h3 {
	color: #000 !important;
	font-size: 16px !important;
	font-weight: bold !important
}
.search {
	background: url(../img/bg.jpg);
	height: 270px;
	background-position: top right
}
.onecikan {
	display: none
}
.nn {
	display: none
}
#myCarousel {
	display: none
}
}
@media (max-width: 480px) {
.main {
 margin-top: 0px !important; 
}
.pos {
	position: relative;
	height: 100px;
}
.ilanlar li {
	float: left;
	margin-right: 1%;
	width: 48%;
	margin-top: 5px;
	height: 125px;
	border: solid 1px #eee;
	padding: 10px;
	text-align: center;
	position: relative;
	font-size: 11px
}
#firsat .span3 {
	width: 50% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 200px
}
.navbar-brand img {
	width: auto !important;
	height: 33px !important;
	margin-top: 0px
}
.navbar-default {
	min-height: 50px !important;
	margin-bottom: 0px !important;
	background-image: none !important;
	background-color: #fff;
	border: none !important;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	-webkit-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
	padding-top: 10px;
	padding-bottom: 10px;
	margin-bottom: 10px
}
.search {
	background: url(../img/bg.jpg);
	height: 250px;
	background-position: top right
}
.search h2 {
	color: #fff !important;
	font-size: 16px !important;
	margin-bottom: 10px;
}
.g-recaptcha {
	transform: scale(0.9);
	transform-origin: 0 0
}
.media-heading {
	font-weight: bold !important;
	font-size: 12px !important
}
.media-body {
	font-size: 12px !important
}
}
 @media (max-width: 350px) {
.pos {
	position: relative;
	height: 100px;
}
.g-recaptcha {
	transform: scale(0.6);
	transform-origin: 0 0
}
#firsat .span3 {
	width: 100% !important;
	float: left;
	list-style-type: none;
	margin: 0 !important;
	border: solid 0px #e8e8e8;
	background-color: #fff !important;
	padding: 0px !important;
	border-right: solid 1px #eee;
	padding: 5px !important;
	text-align: center;
	height: 200px
}
.ilanlar li {
	float: left;
	margin-right: 0;
	width: 100%;
	margin-top: 5px;
	height: 125px;
	border: solid 1px #eee;
	padding: 10px;
	text-align: center;
	position: relative;
	font-size: 11px
}
.pull-right {
	float: none !important;
}
.media-heading {
	font-weight: bold !important;
	font-size: 11px !important
}
.media-body {
	font-size: 11px !important
}
}
@media (max-width: 1200px) {
.navbar-header {
	float: none !important;
}
.navbar-left, .navbar-right {
	float: none !important;
}
.navbar-toggle {
	display: block !important;
}
.navbar-collapse {
	border-top: 1px solid transparent;
	box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
	float: none !important
}
.navbar-fixed-top {
	top: 0;
	border-width: 0 0 1px;
}
.navbar-collapse.collapse {
	display: none!important;
}
.navbar-nav {
	float: none!important;
	margin-top: 7.5px;
	margin-left: 0px !important;
	margin-bottom:10px
}
.navbar-nav>li {
	float: none;
	width: 100% !important
}
.navbar-nav>li>a {
	padding-top: 10px;
	padding-bottom: 10px;
	display: block !important;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
}
.collapse.in {
	display: block !important;
}
.navbar-collapse {
	padding-left: 0px !important
}
.navbar-collapse.in {
	overflow-y: auto !important;
}
.navbar-nav .open .dropdown-menu {
	position: static;
	float: none;
	width: auto;
	margin-top: 0;
	background-color: transparent;
	border: 0;
	box-shadow: none;
}
.navbar-nav .open .dropdown-menu>li>a, .navbar-nav .open .dropdown-menu .dropdown-header {
	padding: 5px 15px 5px 25px;
}
.navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
	color: #999;
}
.navbar-inverse .navbar-nav .open .dropdown-menu>li>a:hover, .navbar-inverse .navbar-nav .open .dropdown-menu>li>a:focus {
	color: #fff;
	background-color: transparent;
	background-image: none;
}

.navbar-default .navbar-nav>li {
	margin-left:0px !important;
	margin-right:0px !important	
}
.onecikan {
	display: none
}
.nn {
	display: none
}
#myCarousel {
	display: none
}
.main {
	margin-top: 20px !important
}
.magaza {
	display: block
}
.duz {
	float:none !important;
	text-align:center
}
.crr {
	text-align:center
}
}
a.gflag {
    vertical-align: middle;
    font-size: 24px;
    padding: 1px 0;
    background-repeat: no-repeat;
    background-image: url("http://joomla-gtranslate.googlecode.com/svn/trunk/mod_gtranslate/tmpl/lang/24.png");
}
#google_translate_element2 {
	display:none
}
@media (max-width: 1280px) {
.main {
 margin-top: 0px !important; 
}
}
.site-rengi{
	background-color: '.$renk.' !important;
	border-color: '.$renk.' !important;
	color: #fff !important
}

.site-tepe{
    background-color: #FFFFFF;
    border-bottom :1px solid #EEEEEE;
	padding:10px;
	color:#676767;
}

.breadcrumb {
	background-color: #676767 !important;
	margin-top: 15px;
	color: #fff;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}
.breadcrumb a {
	color: #fff !important
}
.kutu {
	padding:15px;
	margin-bottom:20px;
	border:2px solid transparent;
	border-radius:0px
}
.kutu-yesil {
	color:#676767;
	background-color:#FFF;
	border-color:'.$renk.';
}
.kutubuton{
	margin-top: -16px;
	margin-right:-16px !important;
	background-color: '.$renk.' !important;
	padding:16px !important;
	float: right;
	color: #FFF !important;
}
/*ANASAYFA BANNER*/
.hizli-banner {
	border: 1px solid #EEEEEE;
	background-color:#fff;
	padding-top:15px
}
.hizli-banner-orta{
	background-color: rgba(255, 255, 255, 0.9);
	background: rgba(255, 255, 255, 0.9);
	height: 134px;
}
.hizli-banner-orta-kategori{
	background-color: rgba(255, 255, 255, 0.9);
	background: rgba(255, 255, 255, 0.9);

}
.hizli-banner-kategori-adi{
	background-color: '.$renk.' !important;
	color: #fff !important;
	padding: 10px;
	margin-top: 120px !important;
	cursor: default !important;
	width: 250px !important;
	text-align: center;
	margin-left: 15px !important;
	box-shadow: 0 0px 0 rgba(255, 255, 255, 0) inset, 0 0px 0px rgba(0, 0, 0, 0) !important;
	text-shadow: 0 0px 0 rgba(0, 0, 0, 0) !important;
}
/*ANASAYFA ARAMA*/
.arama-edit {
	width: 350px !important;
	font-size: 12px !important;
	outline:0 !important;
	height: 50px;
}
.arama-buton{
    border:none;
    height: 50px;
	font-size: 18px;
	line-height: 1.3333333;
	border-radius: 0px !important;
	padding-top: 10px;
	padding-right: 14px;
	padding-bottom: 10px;
	padding-left: 25px;
	background-color:#676767;
}
.arama-buton:hover {
    border: none !important;
	color: #fff !important;
	background-color: '.$renk.' !important;
	border-color: '.$renk.' !important;
}
.topmenu {
	background-color: #012b74;
	height: 10px;
	line-height: 10px
}
.topmenu ul {
	margin: 0px !important;
	padding: 0px !important
}
.topmenu li {
	float: left;
	list-style:none
}
.topmenu li a {
	padding: 15px;
	border-left: solid 2px '.$renk.';
	color: #fff;
	font-weight: bold;
	padding-top: 10px;
	padding-bottom: 10px;
	text-decoration: none
}
.topmenu li a:hover {
	background-color: #fff;
	color: '.$renk.';
}
.toplink {
 padding-top: 10px !important;
}
.toplink a {
	background-color: '.$renk.';
	margin-left: 0px !important;
	color: #fff !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
	width: 100% !important;
	padding: 10px !important;
}
.toplink a:hover {
	background-color: #676767 !important
}
/*NAVBAR*/
.navbar .navbar-brand {
	padding: 0 12px;
	line-height: 100px;
	height: 100px;
	padding-top: 10px
}
.navbar-right {
	padding-top: 15px !important;
}
.navbar-default .navbar-nav>li {
	margin-left: 5px;
	margin-right: 5px
}
.navbar-default .navbar-nav>li>a {
	color: #fff;
	background-color: '.$renk.';
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 0px;
	padding:15px !important;
}
.navbar-default .navbar-nav>li>a:hover {
	color:#fff;
}
/*BUTONLAR*/
.buton{
	border: none !important;
    font-size: 14px !important;
	padding-top: 10px !important;
	padding-right: 22px !important;
	padding-bottom: 10px !important;
	padding-left: 22px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}

.butonalink{
	border: none !important;
    font-size: 14px !important;
	padding-top: 12px !important;
	padding-right: 22px !important;
	padding-bottom: 12px !important;
	padding-left: 22px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}

.butonimage{
	border: none !important;
    font-size: 14px !important;
	padding-top: 12px !important;
	padding-right: 12px !important;
	padding-bottom: 12px !important;
	padding-left: 12px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}

.buton-mavi-siyah{
	background-color: #0D79A5 !important;
	border-color: #0D79A5 !important;
	color: #fff !important;
}
.buton-mavi-siyah:hover {
    border: none !important;
	color: #fff !important;
	background-color: #676767 !important;
	border-color: #676767 !important;
	text-decoration: none;
}

.buton-mavi-siyah:active {
outline: 0;
 border: none !important;
 text-decoration: none;
}
.buton-mavi-siyah:focus {
outline: 0;
 border: none !important;
 text-decoration: none;
}

.buton-siyah-mavi{
	background-color: #676767 !important;
	color: #fff !important;
	border: 0px none #676767;
}
.buton-siyah-mavi:hover {
    border: none !important;
	color: #fff !important;
	background-color: #0D79A5 !important;
	border-color: #0D79A5 !important;
	text-decoration: none;
}

.buton-siyah-mavi:active {
outline: 0;
 border: none !important;
 text-decoration: none;
}
.buton-siyah-mavi:focus {
outline: 0;
 border: none !important;
 text-decoration: none;
}

.buton-yesil-siyah{
	background-color: '.$renk.' !important;
	color: #fff !important;
	border: 0px none '.$renk.';
}
.buton-yesil-siyah:hover {
    border: none !important;
	color: #fff !important;
	background-color: #676767 !important;
	border-color: #676767 !important;
	text-decoration: none;
}

.buton-yesil-siyah:active {
outline: 0;
 border: none !important;
 text-decoration: none;
}
.buton-yesil-siyah:focus {
outline: 0;
 border: none !important;
 text-decoration: none;
}


.buton-siyah-yesil{
	background-color: #676767 !important;
	color: #fff !important;
	border: 0px none #676767;
}
.buton-siyah-yesil:hover {
    border: none !important;
	color: #fff !important;
	background-color: '.$renk.' !important;
	border-color: '.$renk.' !important;
	text-decoration: none;
}

.buton-siyah-yesil:active {
outline: 0;
 border: none !important;
 text-decoration: none;
}
.buton-siyah-yesil:focus {
outline: 0;
 border: none !important;
 text-decoration: none;
}


.toplink2 a {
	background-color: #fff !important;
	margin-left: 10px !important;
	color: #000 !important;
	margin-left: 0px !important;
	-webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	box-shadow: 0 0px 0 rgba(255, 255, 255, 0) inset, 0 0px 0px rgba(0, 0, 0, 0) !important;
	text-shadow: 0 0px 0 rgba(0, 0, 0, 0) !important;
}
.toplink2 a:hover {
	background-image: none !important;
	background-color: '.$renk.' !important;
	color: #fff !important
}
.toplink2 a {
	background-color: #fff !important;
	margin-left: 0px !important;
	color: #000 !important;
	margin-left: 0px !important;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
}

/*SAYFA ALT*/
.footer1 {
	background-color:#4b4b4b;
	color:#fff;
	border-top:solid 5px '.$renk.';
	padding-top:25px;
	padding-bottom:25px;
	-webkit-border-radius: 0px !important;
	-moz-border-radius: 0px !important;
	border-radius: 0px !important;
	font-size: 12px;
}
.footer1 ul {
	margin:0px !important;
	padding:0px !important
}
.footer1 ul li {
	list-style:none;
	line-height:20px;
}
.footer1 ul li a {
	color:#fff !important;
}
.footer-line {
	border-right:solid 2px #595959
}
.footer2{
	padding-top:10px;
	padding-bottom:10px;
	text-align:center;
	font-size:12px;
	background-color:#676767;
	color:#fff;
	border-top:solid 2px #595959
}

.scrollToTop{
	width: 50px;
	height: 50px;
	text-align: center;
	font-weight: bold;
	color: #444;
	text-decoration: none;
	position: fixed;
	right: 20px;
	display: none;
	background-image: url(../img/yukari.png);
	background-repeat: no-repeat;
	bottom: 30px;
}
.scrollToTop:hover{
	text-decoration:none;
}

.kucuk-edit {
	height: 35px !important;
}

.altbosluk{
    margin-bottom:15px;
}

.hit {
	background-color: #fff;
	padding-top: 10px;
	padding-right: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
}

.file-loading {
    top: 0;
    right: 0;
    width: 25px;
    height: 25px;
    font-size: 999px;
    text-align: right;
    color: #fff;
    background: transparent url("../img/loading.gif") top left no-repeat;
    border: none;
}

.file-object {
    margin: 0 0 -5px 0;
    padding: 0;
}

.btn-file {
    position: relative;
    overflow: hidden;
}

.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    text-align: right;
    opacity: 0;
    background: none repeat scroll 0 0 transparent;
    cursor: inherit;
    display: block;
}

.file-caption-name {
    display: inline-block;
    overflow: hidden;
    height: 20px;
    word-break: break-all;
}

.input-group-lg .file-caption-name {
    height: 25px;
}

.file-preview-detail-modal {
    text-align: left;
}

.file-error-message {
    color: #a94442;
    background-color: #f2dede;
    margin: 5px;
    border: 1px solid #ebccd1;
    border-radius: 0px;
    padding: 15px;
}

.file-error-message pre, .file-error-message ul {
    margin: 0;
    text-align: left;
}

.file-error-message pre {
    margin: 5px 0;
}

.file-caption-disabled {
    background-color: #EEEEEE;
    cursor: not-allowed;
    opacity: 1;
}

.file-preview {
    border-radius: 0px;
    border: 1px solid #ddd;
    padding: 5px;
    width: 100%;
    margin-bottom: 5px;
}

.file-preview-frame {
    display: table;
    margin: 8px;
    height: 160px;
    border: 1px solid #ddd;
    box-shadow: 1px 1px 5px 0 #a2958a;
    padding: 6px;
    float: left;
    text-align: center;
    vertical-align: middle;
}

.file-preview-frame:not(.file-preview-error):hover {
    box-shadow: 3px 3px 5px 0 #333;
}

.file-preview-image {
    height: 160px;
    vertical-align: middle;
}

.file-preview-text {
    text-align: left;
    width: 160px;
    margin-bottom: 2px;
    color: #428bca;
    background: #fff;
    overflow-x: hidden;
}

.file-preview-other {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    width: 160px;
    height: 160px;
    border: 2px solid #999;
    border-radius: 0px;
}

.file-preview-other:hover {
    opacity: 0.8;
}

.file-actions, .file-other-error {
    text-align: left;
}

.file-icon-lg {
    font-size: 1.2em;
}

.file-icon-2x {
    font-size: 2.4em;
}

.file-icon-4x {
    font-size: 4.8em;
}

.file-input-new .file-preview, .file-input-new .close, .file-input-new .glyphicon-file,
.file-input-new .fileinput-remove-button, .file-input-new .fileinput-upload-button,
.file-input-ajax-new .fileinput-remove-button, .file-input-ajax-new .fileinput-upload-button {
    display: none;
}

.file-thumb-loading {
    background: transparent url("../img/loading.gif") no-repeat scroll center center content-box !important;
}

.file-actions {
    margin-top: 15px;
}

.file-footer-buttons {
    float: right;
}

.file-upload-indicator {
    padding-top: 2px;
    cursor: default;
    opacity: 0.8;
    width: 60%;
}

.file-upload-indicator:hover {
    font-weight: bold;
    opacity: 1;
}

.file-footer-caption {
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 160px;
    text-align: center;
    padding-top: 4px;
    font-size: 11px;
    color: #777;
    margin: 5px auto 10px auto;
}

.file-preview-error {
    opacity: 0.65;
    box-shadow: none;
}

.file-preview-frame:not(.file-preview-error) .file-footer-caption:hover {
    color: #000;
}

.file-drop-zone {
    border: 1px dashed #aaa;
    border-radius: 0px;
    height: 100%;
    text-align: center;
    vertical-align: middle;
    margin: 12px 15px 12px 12px;
    padding: 5px;
}

.file-drop-zone-title {
    color: #aaa;
    font-size: 40px;
    padding: 85px 10px;
}

.file-highlighted {
    border: 2px dashed #999 !important;
    background-color: #f0f0f0;
}

.file-uploading {
    background: url("../img/loading-sm.gif") no-repeat center bottom 10px;
    opacity: 0.65;
}

.file-thumb-progress .progress, .file-thumb-progress .progress-bar {
    height: 10px;
    font-size: 9px;
    line-height: 10px;
}

.file-thumbnail-footer {
    position: relative;
}

.file-thumb-progress {
    position: absolute;
    top: 22px;
    left: 0;
    right: 0;
}

/* IE 10 fix */
.btn-file ::-ms-browse {
    width:100%;
    height:100%;
	padding-bottom:9px;
	padding-top:9px;
}

.form-group label{
    font-weight:normal !important;
}
.carousel-control.left { background-image:none !important }
.carousel-control.right { background-image:none !important }
.slide { border:none }
.carousel-inner > .item > img,
.carousel-inner > .item > a > img {
  min-height: 300px;
  max-height: 300px;
  min-width:100% !important

}
.bannerc img {
	width:100% !important
}
.navbar-default .navbar-nav>li a {
	background-color:'.$renk.' !important
}
';
?>