<template>
    <div>
        <div v-if="loading">
            Loading...
        </div>
        <div v-else>
            <h1>Manage videos.
                <small v-if="videos.length > 0">{{pagination.total}} videos, displayed by {{pagination.per_page}} on
                    {{pagination.last_page}}
                    pages.
                </small>
            </h1>

            <toolbox>
                <div class="form-group">
                    <input v-model="search" @keydown.enter="loadData"
                           class="form-control" placeholder="mia khalifa, ...">
                </div>
                <button type="submit" @click="loadData" @submit.prevent="loadData"
                        class="btn btn-default btn-block">Search in title
                </button>
                <hr>
                <label for="per_page">Videos per page:</label>
                <select id="per_page" v-model="pagination.per_page" class="form-control">
                    <option v-for="value in [20, 50, 100, 200, 500]">{{value}}</option>
                </select>
            </toolbox>

            <div v-if="videos.length > 0">
                <div class="text-center">
                    <pagination :pagination="pagination" :options="paginationOptions" :callback="loadData"></pagination>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Site</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Duration</th>
                            <th class="column-thumb">Thumb</th>
                            <th class="column-actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="video in videos" :class="{'danger': videosErrors[video.id]}">
                            <td>{{video.id}}</td>
                            <td><a :href="video.site.url">{{ video.site.name }}</a></td>
                            <td><a :href="video.url">{{ video.title }}</a></td>
                            <td>{{video.tags}}</td>
                            <td>{{video.duration}}</td>
                            <td>
                                <a :href="video.thumbnail_url" class="thumbnail">
                                    <img :src="video.thumbnail_url" @error="imageError($event, video.id)">
                                </a>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-danger" @click="deleteVideo($event, video.id)">Delete
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <pagination :pagination="pagination" :options="paginationOptions" :callback="loadData"></pagination>
                </div>
            </div>
            <div v-else>
                <p class="text-center">
                    No videos to display.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import debounce from 'lodash.debounce';

    export default {
        data () {
            return {
                loading: true,
                url: '/admin',
                search: '',
                headers: {
                    id: '#',
                    title: 'Title',
                    duration: 'Duration'
                },
                videos: [],
                videosErrors: {},
                pagination: {
                    current_page: 1,
                    per_page: 50,
                },
                paginationOptions: {
                    offset: 5,
                }
            }
        },
        watch: {
            search () {
                this.debounceLoadData();
            }
        },
        methods: {
            loadData() {
                const options = {
                    params: {
                        paginate: this.pagination.per_page,
                        page: this.pagination.current_page,
                    }
                };

                if (this.search) {
                    options.params.search = this.search;
                    delete options.params.page;
                }

                axios
                    .get(this.url, options)
                    .then(response => {
                        this.loading = false;
                        this.videos = response.data.data;
                        console.log(this.videos[0]);
                        this.getPaginationValuesFromJson(response.data);
                    })
                    .catch(console.err)
            },

            debounceLoadData: debounce(function () {
                this.loadData()
            }, 400),

            getPaginationValuesFromJson(json) {
                this.$set(this, 'pagination', {
                    current_page: json.current_page,
                    last_page: json.last_page,
                    per_page: json.per_page,
                    from: json.from,
                    to: json.to,
                    total: json.total,
                });
            },

            deleteVideo(e, videoId) {
                const yes = confirm(`Do you really want to delete the video « ${videoId} » ?`);

                if (yes) {
                    axios
                        .delete(`/admin/delete_video/${videoId}`)
                        .then(response => {
                            const video = this.videos.find(video => video.id === videoId);

                            if (video) {
                                this.videos.splice(this.videos.indexOf(video), 1);
                                this.pagination.total -= 1;
                            }
                        })
                        .catch(alert)
                }
            },

            imageError(e, videoId) {
                this.$set(this.videosErrors, videoId, true);
            }
        },
        mounted () {
            this.loadData()
        }
    }
</script>

<style scoped>
    .column-thumb {
        width: 70px;
    }

    .column-actions {
        width: 1%;
    }
</style>
