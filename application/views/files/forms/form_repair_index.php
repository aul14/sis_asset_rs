<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Files - Repair Form">
      <template v-slot:buttons>
        <table-init></table-init>
        <add-data modal="repair_form"></add-data>
        <edit-data modal="inventory_form"></edit-data>
        <delete-data modal=""></delete-data>
        <print-data modal="inventory_print"></print-data>
        <table-advance-search overlay="advanced_search"></table-advance-search>
        <table-column-view></table-column-view>
      </template>
      <template v-slot:content>
        <samrs-overlay overlay-id="advanced_search" title="Advanced Search">
          <advanced-search-box></advanced-search-box>
        </samrs-overlay>
      </template>
    </action-button-card>
    <table-view-card>
      <template v-slot:table-content>
        <table class="samrs-table1 table samrs-tableview samrs-table-striped table-hover">
          <thead>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php for ($i = 0; $i <= 100; $i++) { ?>
              <tr>
                <td class="text-center"><input class="select_checkbox" type="checkbox" name="" value=""></td>
                <td><?php echo $no; ?></td>
                <td>Data 2_<?php echo $no; ?></td>
                <td>Data 3_<?php echo $no; ?></td>
                <td>Data 4_<?php echo $no; ?></td>
              </tr>
              <?php $no++ ?>
            <?php } ?>
          </tbody>
        </table>
      </template>
    </table-view-card>
  </main-app>
</main>
<script>
  function TableData() {
    let table = $('.samrs-table1').DataTable({
      columns: [{
          title: '<input type="checkbox"/>',
          name: null
        },
        {
          title: 'No',
          name: 'No'
        },
        {
          title: 'No Document',
          name: 'No Document'
        },
        {
          title: 'Asset Name',
          name: 'Asset Name'
        },
        {
          title: 'Type Of Activity',
          name: 'Asset name'
        },
      ],
      retrieve: true,
      dom: 'Rrt<"samrs-grid grid-3"<"grid-box text-sm"l><"grid-box text-center text-sm"i><"grid-box text-sm"p>>',
      searching: true,
      scrollX: true,
      scrollY: "50vh",
      scrollCollapse: true,
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 500, 1000],
      colResize: {
        "handleWidth": 50
      }
    });
    return table;
  }
</script>