<template>

  <div class="row">
    <div class="col-lg-4" v-for="author in authors" style="text-align: center">
      <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
      <h2>{{ author.name }}</h2>
      <p><a class="btn btn-secondary" @click="showAuthor(author.id)">Смотреть подробнее »</a></p>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Authors",
    data() {
      return {
        authors: [],
      }
    },
    mounted() {
      this.getAuthors()
    },
    methods: {
      getAuthors() {
        axios.get('/authors').then((response) => {
          this.authors = response.data.data;
        });
      },
      showAuthor(author_id){
        this.$emit("showContent", 'showAuthor', author_id );
      }
    }
  }
</script>

<style scoped>

</style>
