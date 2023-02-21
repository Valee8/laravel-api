<script >
import axios from 'axios';

const API_URL = 'http://localhost:8000/api/';
const API_VER = 'v1/';
const API = API_URL + API_VER;

const EMPTY_NEW_MOVIE = {
  tags_id: []
};
export default {
  data() {

    return {
      movies: [],
      genres: [],
      tags: [],
      newMovie: { ...EMPTY_NEW_MOVIE },
      state: {
        movieForm: false
      }
    }
  },
  methods: {
    updateData() {
      axios.get(API + 'movie/all')
        .then(res => {
          const data = res.data;
          const success = data.success;
          const response = data.response;

          const movies = response.movies;
          const genres = response.genres;
          const tags = response.tags;

          if (success) {
            this.movies = movies;
            this.genres = genres;
            this.tags = tags;
          }
        })
        .catch(err => console.log(err));
    },
    movieEdit(movie) {

      console.log('movie', movie);
      console.log('newMovie', this.newMovie);

      this.newMovie = { ...movie };
      this.newMovie.tags_id = [];

      for (let i = 0; i < movie.tags.length; i++) {

        const tag = movie.tags[i];
        this.newMovie.tags_id.push(tag.id);
      }

      this.state.movieForm = true;
    },
    movieDelete(movie) {
      axios.delete(API + 'movie/delete/' + movie.id)
        .then(res => {

          const data = res.data;
          const success = data.success;

          if (success)
            this.updateData();
        })
        .catch(err => console.log(err));
    },
    movieSubmit(e) {

      e.preventDefault();

      const newMovie = this.newMovie;
      const actualApi = API + (
        'id' in newMovie
          ? 'movie/update/' + this.newMovie.id
          : 'movie/store'
      );

      console.log(newMovie);
      console.log(actualApi);

      axios.post(actualApi, newMovie)
        .then(res => {
          const data = res.data;
          const success = data.success;

          if (success) {
            this.closeForm();
            this.updateData();
          }
        })
        .catch(err => console.log(err));
    },
    closeForm() {
      this.newMovie = { ...EMPTY_NEW_MOVIE };
      this.state.movieForm = false;
    },
  },
  mounted() {
    this.updateData();
  }
};
</script>

<template>
  <div>
    <h1>Movies</h1>
    <form v-if="state.movieForm">
      <label for="name">Name</label>
      <input type="text" name="name" v-model="newMovie.name">
      <br>
      <label for="year">Year</label>
      <input type="number" name="year" v-model="newMovie.year">
      <br>
      <label for="cashOut">Cash out</label>
      <input type="number" name="cashOut" v-model="newMovie.cashOut">
      <br>
      <label for="genre">Genre</label>
      <select name="genre_id" v-model="newMovie.genre_id">
        <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
      </select>
      <br>
      <label>Tags:</label>
      <br>
      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :id="'tag-' + tag.id" :value="tag.id" v-model="newMovie.tags_id">
        <label :for="'tag-' + tag.id">{{ tag.name }}</label>
      </div>

      <button @click="closeForm">CANCEL</button>
      <input type="submit" @click="movieSubmit"
        :value="'id' in newMovie ? 'UPDATE MOVIE: ' + newMovie.id : 'CREATE NEW MOVIE'">
    </form>
    <div v-else>
      <button @click="state.movieForm = true">CREATE NEW MOVIE</button>
      <ul>
        <li v-for="movie in movies" :key="movie.id">
          {{ movie.name }}
          <br>
          <button @click="movieEdit(movie)">EDIT</button>
          <button @click="movieDelete(movie)">DELETE</button>
          <ul>
            <li v-for="tag in movie.tags" :key="tag.id">
              {{ tag.name }}
            </li>
          </ul>
        </li>
      </ul>
    </div>
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
