<template>
  <div class="row card-content">
    <contact-action-card></contact-action-card>
    <contact-list-card></contact-list-card>
  </div>
</template>

<script>
module.exports={
  data(){
    return{
      contactList:[],
      colors: [
          "#FFB900",
          "#c8cf00",
          "#B50E0E",
          "#E81123",
          "#B4009E",
          "#5C2D91",
          "#0078D7",
          "#ff0087",
          "#008272",
          "#107C10",
          "#2cabe3",
          "#7113d6",
          "#066056",
          "#cc6e34",
          "#cc57ca"
        ]
    }
  },
  components:{
      'contact-action-card':httpVueLoader(BASE_URL+'vue-components/contact/ui-component/contact_action_card.vue?v=1.0'),
      'contact-list-card':httpVueLoader(BASE_URL+'vue-components/contact/ui-component/contact_list_card.vue?v=1.1'),
  },
  created: function(){
    let data = axios.get(BASE_URL+'contact/data_list')
    .then(response => {
        this.contactList = response.data;
      // let filterInput = $('input[with-state="filtering"]').val();
      // let filterData = response.data.filter(function(obj) {
      //   return obj.contactType === filterInput;
      // });
      // if (filterInput === '') {
      //   this.contactList = response.data;
      // }else {
      //   this.contactList = filterData;
      // }
      // console.log(this.contactList);
    });
  },
  updated(){
    $('.quick_search_contact').on('keyup', function(){
      let searchValue = $(this).val().toUpperCase();
      // console.log(searchValue);
      $('.list-data *').filter(function(){
        $(this).not('.contact-icon, .contact-info *,  .contact-action, #btn-contact-edit, #btn-contact-hapus, #btn-icon, .avatar-circle, .char_name').toggle($(this).text().toUpperCase().indexOf(searchValue) > -1);
      });
    });
    function changecontactContent(){
      let newHeight = $('.card-content').height() - 30;
      let contentHeight = $('.card-content').height();
      $('.contactlist-scrollable').css('max-height',contentHeight+'px');
      return $('.contactlist-scrollable').css('height',newHeight+'px');
    }
    changecontactContent();
    $(window).resize(function(){
      changecontactContent();
    });
  }
}
</script>
