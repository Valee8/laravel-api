<script>

import axios from 'axios';

export default {

  mounted() {

    axios.get('http://127.0.0.1:8000/movie/v1/all')
      .then(res => {

        const data = res.data;
        const success = data.success;
        const movies = data.response;

        //console.log(movies);
      })
      .catch(err => console.error(err));
  }
};

</script>

<template>
  <h1>
    Hello world
</h1>
</template>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
