<template>
  <div class="row">

    <div class="col-md-2">
      <form v-on:submit.prevent="searchNews" id="searchForm">
        <div class="form-group">
          <label for="searchInput">Введите заголовок</label>
          <input class="form-control" id="searchInput" type="search" placeholder="Search" aria-label="Search" v-model="search">
        </div>
        <p>Выберите раздел</p>
        <ul class="list-group list-group-flush">
          <li class="list-group-item" v-for="section in sections">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="sections[]" :id="'inlineCheckbox' + section.id" :value="section.id">
              <label class="custom-control-label" :for="'inlineCheckbox'+ section.id">{{ section.name }}</label>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item" v-for="child in section.child">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="sections[]" :id="'inlineCheckbox' + child.id" :value="child.id">
                  <label class="custom-control-label" :for="'inlineCheckbox'+ child.id">{{ child.name }}</label>
                </div>
              </li>
            </ul>
          </li>
        </ul>
        <button type="submit" class="btn btn-primary">Найти</button>
      </form>
    </div>
    <div class="col-md-10">
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
  </div>
</template>

<script>
  export default {
    name: "Search",
    data() {
      return {
        news: [],
        search: '',
        sections: [],
        showAlert: false,
        timerAlert: false,
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
      searchNews() {
        let formData = new FormData(document.getElementById("searchForm"));
        formData.append('search', this.search);
        axios.post('/news/search', formData).then((response) => {
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
