<style>
.news-item.promo-list-item {
	padding: 25px;
	position: relative;
}
.news-item.promo-list-item:nth-child(even) {
	background-color: #EFF0F1;
}
.news-item.promo-list-item .image-wrapper {
	width: 100px;
	float: left;
}
.news-item.promo-list-item:after {
	content:'';
	display:block;
	clear: both;
}
.news-item.promo-list-item .image-wrapper img {
	display: block;
	width: 100%;
	height: auto;
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
}
.news-item.promo-list-item.has-image .caption {
	margin-left: 120px;
}
.news-item.promo-list-item .caption h3 {
	font-size: 18px;
	color: #981e32;
}
.news-item.promo-list-item .caption .excerpt {
	font-size: 14px;
}
.news-item.promo-list-item .caption > p {
	margin: 0;
	padding: 0;
}
.news-item.promo-list-item .caption > p > a {
	font-size: 14px;
}
.news-item.promo-list-item .link a {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	display: block;
	font-size: 0;
}
.news-item.promo-list-item .link a:hover {
	background: rgba(0,0,0,0.1);
}
.cpb-column.small .news-item.promo-list-item .image-wrapper {
	width: auto;
	float: none;
	margin-bottom: 16px;
}
.cpb-column.small .news-item.promo-list-item.has-image .caption {
	margin-left: 0;
}
</style>