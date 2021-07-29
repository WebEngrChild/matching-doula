<template>
    <div v-if="this.isLikedBy">
    <b-button v-on:click="clickLike" pill variant="outline-danger" class="bg-danger text-white">お気に入り済み</b-button>
     {{ countLikes }}
    </div>
    <div v-else>
    <b-button v-on:click="clickLike" pill variant="outline-danger">お気に入り</b-button>
     {{ countLikes }}
    </div>
</template>

<script>
export default {
    props: {
        initialIsLikedBy: {
        type: Boolean,
        default: false,
        },

        initialCountLikes: {
        type: Number,
        default: 0,
        },

        authorized: {
        type: Boolean,
        default: false,
        },

        endpoint: {
        type: String,
        },
    },

    data() {
        return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
        }
    },

    methods: {
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true
        this.countLikes = response.data.countLikes
      },
      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
      },
    },
}
</script>
