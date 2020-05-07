<template>
  <div class="row">
    <div class="card col-md-4" v-for="section in sections">
      <div class="card-body">
        <p class="card-text">{{ section.name }}</p>
        <a @click="showSection(section.id)" class="btn btn-primary">Подробнее...</a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Sections",
    data() {
      return {
        sections: [],
      }
    },
    mounted() {
      this.getSections()
    },
    methods: {
      getSections() {
        axios.get('/sections').then((response) => {
          this.sections = response.data.data;
        });
      },
      showSection(section_id) {
        this.$emit("showContent", 'showSection', section_id);
      }
    }
  }
</script>

<style scoped>

</style>
