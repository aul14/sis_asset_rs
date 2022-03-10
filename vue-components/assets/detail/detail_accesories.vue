<template>
	<div class="p-10">
		<div class="table-responsive">
			<table class="accesories_list table samrs-tableview capitalize">
				<thead>
					<tr>
						<th>no</th>
						<th class="th-accesories">accesories</th>
						<th>brand</th>
						<th>type</th>
						<th>price</th>
					</tr>
				</thead>
				<tbody id="tbody-detail-accesories"></tbody>
			</table>
		</div>
	</div>
</template>

<script>
module.exports = {
	mounted() {
		function AccessoriesList() {
			$(".accesories_list").DataTable({
				columns: [
					{ name: "no" },
					{ name: "accesories" },
					{ name: "brand" },
					{ name: "type" },
					{ name: "price" },
				],
				retrieve: true,
				dom: "trp",
				pageLength: 15,
				lengthMenu: [
					15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
					100,
				],
			});
		}
		AccessoriesList();
	},
};
</script>
