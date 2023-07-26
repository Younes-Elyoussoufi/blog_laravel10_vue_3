<template>
    <div>
        <div class="comments-area">
            <h4>{{ post.comments_count }} Comments</h4>
            <div v-if="post.comments_count > 0"
                class="comment-list"
                v-for="comment in comments"
                :key="comment.id"
            >
                <div class="single-comment justify-content-between d-flex">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb">
                            <img src="img/comment/comment_1.png" alt="" />
                        </div>
                        <div class="desc">
                            <p class="comment">
                                {{ comment.content }}
                            </p>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <h5>
                                        <router-link :to="{name:'profile',params:{id:comment.user.id}}" style="color: #0056b3 !important;" class="user mx-1">
                                            {{ comment.user.name }}
                                        </router-link>
                                        
                                    </h5>
                                    <p class="date">
                                        December 4, 2017 at 3:12 pm
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comment-form" style="margin-top: 0 !important">
            <form class="form-contact comment_form" action="#" id="commentForm">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea
                                v-model="comment"
                                class="form-control w-100"
                                name="comment"
                                id="comment"
                                cols="30"
                                rows="9"
                                placeholder="Write Comment"
                            ></textarea>
                        </div>
                    </div>
                </div>
                <div class="load_btn mb-5">
                    <button
                        class="btn_1"
                        @click.prevent="ADD_COMMENT(post.id)"
                    >
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>

import { useStore } from "vuex";
import { onMounted, computed,ref } from "vue";
const store = useStore();
import {  useRoute } from "vue-router";

const route = useRoute();
const props = defineProps({
     post: { required: true },
});

const comment = ref('')
const comments = computed(() => store.state.comments);
 console.log('commmmt')
 console.log(route.params.id)
function ADD_COMMENT(postId) {  
    props['post'].comments_count++

    store.dispatch("ADD_COMMENT", { postId, comment_content: comment.value });
    store.state.comments.push(comment.value)
    comment.value = "";
}
onMounted(() => {
    store.dispatch("GET_COMMENTS_USERS_OF_POST",route.params.id);
    })
</script>

<style scopedv>
ul li {
    cursor: pointer;
}
.cat {
    margin: -15px !important;
}
.user{
   color: #0056b3 !important;
}
</style>
