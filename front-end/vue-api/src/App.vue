<script>

import axios from 'axios';

const api_url = 'http://localhost:8000/';

export default {

  data() {
    return {
      movies: [],
      tags: [],
      genres: [],
      newMovie: {
        tags_id: []
      }
    }
  },
  methods: {
    updateData() {
      axios.get(api_url + 'api/movie/v1/all')
        .then(res => {

          const data = res.data;
          const success = data.success;
          this.movies = data.response.movies;
          this.tags = data.response.tags;
          this.genres = data.response.genres;

          console.log(this.genres);
          console.log(this.movies);
          console.log(this.tags);
        })
        .catch(err => console.error(err));
    },
    movieCreate(e) {
      e.preventDefault();

      const newMovie = this.newMovie;

      axios.post(api_url + 'api/movie/v1/store', newMovie)
        .then(res => {

          const data = res.data;
          const success = data.success;

          this.updateData();

          console.log(newMovie);
        })
        .catch(err => console.error(err));
    }
  },
  mounted() {
    this.updateData();
  }
};

</script>

<template>
  <form>
    <label for="name">Name: </label>
    <input type="text" name="name" v-model="newMovie.name">
    <br>
    <label for="year">Year: </label>
    <input type="text" name="year" v-model="newMovie.year">
    <br>
    <label for="cashOut">Cash Out: </label>
    <input type="number" name="cashOut" v-model="newMovie.cashOut">
    <br>
    <label name="genre">Genres: </label>
    <select name="genre_id" v-model="newMovie.genre_id">
      <option v-for="genre in genres" :value="genre.id" :key="genre.id">{{ genre.name }}</option>
    </select>
    <br>
    <div v-for="tag in tags" :key="tag.id">
      <input type="checkbox" :value="tag.id" v-model="newMovie.tags_id">
      <label :for="tag.id">{{ tag.name }}</label>
    </div>
    <br>
    <input type="submit" value="CREATE" @click="movieCreate">
  </form>

  <h1>
    Movies
  </h1>

  <div v-for="(genre, index) in genres" :key="index">
    <h2>
      {{ genre.name }}
    </h2>

    <ul v-for="movie in movies">
      <li v-if="genre.id === movie.genre_id">
        {{ movie.name }}
      </li>
    </ul>

  </div>
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
