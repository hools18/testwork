<template>
  <div id="app">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <a class="navbar-brand">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item" v-for="tab in tabs"
              :key="tab.name"
              :class="[ currentTab == tab.name ? 'active' : '' ]"
              v-on:click="currentTab = tab.name">
            <a class="nav-link" data-url="news">{{ tab.title }}</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <component v-bind:is="currentTabComponent" @showContent="showContentBlock" :content-id="content_id"></component>
    </div>
    <div class="footer">
    </div>
  </div>
</template>

<script>

  import news from './components/Block/News';
  import sections from './components/Block/Sections';
  import authors from './components/Block/Authors';
  import search from './components/Block/Search';
  import showAuthor from './components/Block/ShowAuthor';
  import showNews from './components/Block/ShowNews';
  import showSection from './components/Block/ShowSection';

  export default {
    name: 'App',
    components: {
      news,
      sections,
      authors,
      search,
      showAuthor,
      showSection,
      showNews
    },
    data() {
      return {
        sound_status: 0,
        content_id: 0,
        showChatBlock: false,
        currentTab: 'news',
        tabs: [
          {'name': 'news', 'title': 'Новости'},
          {'name': 'authors', 'title': 'Авторы'},
          {'name': 'sections', 'title': 'Разделы'},
          {'name': 'search', 'title': 'Поиск'}
        ]
      }
    },
    mounted() {

    },
    computed: {
      currentTabComponent: function () {
        return this.currentTab;
      }
    },
    methods: {
      showContentBlock(block_name, content_id) {
        this.content_id = content_id;
        this.currentTab = block_name;

      }
    }
  }
</script>

<style>

</style>
