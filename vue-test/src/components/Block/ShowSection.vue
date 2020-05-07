<template>
  <div>
    <div class="row">
      <div class="card col-md-4">
        <div class="card-body">
          <p class="card-text">{{ section.name }}</p>
        </div>
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
    name: "ShowSection",
    props: ['contentId'],
    data() {
      return {
        section: [],
        news: [],
        section_id: this.contentId
      }
    },
    mounted() {
      this.getSection()
    },
    methods: {
      getSection() {
        axios.get('/sections', {
          params: {
            section_id: this.section_id
          }
        }).then((response) => {
          this.section = response.data.data;
        });
        axios.get('/sections/getNews', {
          params: {
            section_id: this.section_id
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
