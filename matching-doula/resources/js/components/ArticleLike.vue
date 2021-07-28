<template>
    <div v-if="this.isLikedBy">
    <b-button pill variant="outline-danger" class="p-3 mb-2 bg-danger text-white">お気に入り</b-button>
     {{ countLikes }}
    </div>
    <div v-else>
    <b-button pill variant="outline-danger">お気に入り</b-button>
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
},
    data() {
      return {
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
      }
    },
  }
</script>
