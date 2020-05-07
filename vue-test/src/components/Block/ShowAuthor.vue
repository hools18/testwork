<template>
  <div>
    <div class="row">
      <div class="col-lg-4" style="text-align: center">
        <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
        <h2>{{ author.name }}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4" v-for="item in news">
        <div class="card flex-md-row mb-4 box-shadow h-md-250">
          <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary">ID: {{ item.id }}</strong>
            <h3 class="mb-0">
              <a class="text-dark" @click="showNews(item.id)">{{ item.title }}</a>
            </h3>
            <p class="card-text mb-auto">{{ item.subtitle }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
  export default {
    name: "ShowAuthor",
    props: ['contentId'],
    data() {
      return {
        author: [],
        news: [],
        author_id: this.contentId
      }
    },
    mounted() {
      this.getAuthors()
    },
    methods: {
      getAuthors() {
        axios.get('/authors', {
          params: {
            author_id: this.author_id
          }
        }).then((response) => {
          this.author = response.data.data;
        });
        axios.get('/authors/getNews', {
          params: {
            author_id: this.author_id
          }
        }).then((response) => {
          this.news = response.data.data;
        });
      },
      showNews(news_id) {
        this.$emit("showContent", 'showNews', news_id);
      }
    }
  }
</script>

<style scoped>

</style>
