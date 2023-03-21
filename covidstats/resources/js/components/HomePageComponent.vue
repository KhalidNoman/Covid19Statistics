<template>
  <div>
    <b-nav tabs style="margin-bottom: 30px">
    <b-nav-item to="/" exact-active-class="active">World Stats</b-nav-item>
    <b-nav-item to="/country-list" exact-active-class="active">Country Stats</b-nav-item>

  </b-nav>
  <router-view></router-view>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
