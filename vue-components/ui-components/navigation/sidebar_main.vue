<template>
	<nav class="sidebar-nav">
		<ul id="sidebarnav">
			<slot></slot>
		</ul>
	</nav>
</template>
<script>
module.exports = {
	mounted() {
		function sidebarClick() {
			$(function() {
				$("#sidebarnav a").on("click", function(e) {
					if (!$(this).hasClass("active")) {
						// hide any open menus and remove all other classes
						$("ul", $(this).parents("ul:first")).removeClass("in");
						$("a", $(this).parents("ul:first")).removeClass("active");

					} else if ($(this).is("ul")) {
						$(this).addClass('in');
					}
				});
				$('#sidebarnav a').on('click', function(e) {
					if (!$(this).hasClass("active")) {
						// hide any open menus and remove all other classes
						$("ul", $(this).parents("ul:first")).removeClass("in");
						$("a", $(this).parents("ul:first")).removeClass("active");

						// open our new menu and add the open class
						$(this).next("ul").addClass("in");
						$(this).addClass("active");

					} else if ($(this).hasClass("active")) {
						$(this).removeClass("active");
						$(this).parents("ul:first").removeClass("active");
						$(this).next("ul").removeClass("in");
					}
				})
				$('#sidebarnav >li >a.has-arrow').on('click', function (e) {
						e.preventDefault();
				});
			})
		}
		$(document).ready(function() {
			sidebarClick();
		})
	}
};
</script>
