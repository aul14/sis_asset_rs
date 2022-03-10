<template>
  <li class="sidebar-item">
      <a :class="'sidebar-link waves-effect waves-dark '+haveArrow" :href="menuLink">
        <i :class="icons"></i>
        <span class="hide-menu">{{ menuName }}</span>
      </a>
      <slot name="dropdown-menu"></slot>
  </li>
</template>

<script>
module.exports = {
  props:{
    icons:{
      type:String,
      default: 'fas fa-home',
    },
    menuName:{
      type:String,
      default: 'Menu',
    },
    menuLink:{
      type:String,
      default:'javascript:void(0)',
    },
    haveArrow:{
      type: String,
      default:'',
    }
  }
}

</script>
