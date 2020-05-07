<template>
  <div class="row">
    <h2>{{ news.title }}</h2>
    <hr>
    <h5>{{ news.subtitle }}</h5>
    <hr>
    <p>{{ news.text }}</p>
  </div>
</template>

<script>
  export default {
    name: "ShowNews",
    props: ['contentId'],
    data() {
      return {
        news: [],
        news_id: this.contentId
      }
    },
    mounted() {
      this.getNews()
    },
    methods: {
      getNews() {
        axios.get('/news', {
          params: {
            news_id: this.news_id
          }
        }).then((response) => {
          this.news = response.data.data;
        });
      }
    }
  }
</script>

<style scoped>

</style>
