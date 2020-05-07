<template>
  <div>
    <form class="form-inline my-2 my-lg-0" v-on:submit.prevent="searchNews">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Найти</button>
    </form>
    <div class="row">
      <div class="alert alert-info" role="alert" v-if="showAlert">
        К сожаление по вашему запросу ничего не найдено.
      </div>
    </div>
    <div class="row">
      <div class="col-md-4" v-for="item in news">
        <div class="card flex-md-row mb-4 box-shadow h-md-250">
          <div class="card-body d-flex flex-column align-items-start">
            <strong class="d-inline-block mb-2 text-primary">ID: {{ item.id }}</strong>
            <h3 class="mb-0">
              <a class="text-dark" href="#">{{ item.title }}</a>
            </h3>
            <p class="card-text mb-auto">{{ item.subtitle }}</p>
            <a>Continue reading</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Search",
    data() {
      return {
        news: [],
        search: '',
        showAlert: false,
        timerAlert: false,
      }
    },
    methods: {
      searchNews() {
        axios.get('/news/search', {
          params: {
            search: this.search

          }
        }).then((response) => {
          let content = response.data.data;
          this.news = content;
          if (content.length == 0) {
            this.showAlert = true;
            if (this.timerAlert) clearTimeout(this.timerAlert);
            this.timerAlert = setTimeout(() => {
              this.showAlert = false;
            }, 1000)
          }


        });
      },
    }
  }
</script>

<style scoped>

</style>
