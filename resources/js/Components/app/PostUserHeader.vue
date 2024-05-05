<script setup>
import {Link} from '@inertiajs/vue3';
import {ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";
import dayjs from 'dayjs';
import 'dayjs/locale/id'; // Optionally, if you want to use Indonesian locale
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

defineProps({
    post: {
        type: Object
    },
    showTime: {
        type: Boolean,
        default: true
    }
})

</script>

<template>
    <div class="flex items-center gap-2 ">
        <Link :href="route('profile', post.user.username)">
            <img :src="post.user.avatar_url"
                 class="w-[40px] rounded-full border border-2 transition-all hover:border-blue-500"/>
        </Link>
        <div>
            <h4 class="flex items-center font-bold">
                <Link :href="route('profile', post.user.username)" class="hover:underline">
                    {{ post.user.name }}
                </Link>
                <template v-if="post.group">
                    <ChevronRightIcon class="w-4"/>
                    <Link :href="route('group.profile', post.group.slug)" class="hover:underline">
                        {{ post.group.name }}
                    </Link>
                </template>
            </h4>
            <div>
  <small v-if="showTime" class="text-gray-400">{{ formatTime(post.updated_at, true) }} | </small>
  <small v-if="showTime" class="text-gray-400">  {{ formatTime(post.updated_at) }}</small>
</div>

        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.locale('id');
dayjs.extend(relativeTime);
export default {
  methods: {
    formatTime(time, isLongFormat = false) {
      const updateTime = dayjs(time);
      const currentTime = dayjs();
      const diffInMinutes = currentTime.diff(updateTime, 'minute');
      const diffInHours = currentTime.diff(updateTime, 'hour');
      const diffInDays = currentTime.diff(updateTime, 'day');
      const diffInWeeks = currentTime.diff(updateTime, 'week');
      const diffInMonths = currentTime.diff(updateTime, 'month');
      const diffInYears = currentTime.diff(updateTime, 'year');

      if (isLongFormat) {
        if (diffInMinutes < 60) {
          return `${diffInMinutes} menit yang lalu`;
        } else if (diffInHours < 24) {
          return `${Math.floor(diffInHours)} jam yang lalu`;
        } else if (diffInDays < 7) {
          if (diffInDays === 1) {
            return 'Kemarin';
          } else {
            return `${diffInDays} hari yang lalu`;
          }
        } else if (diffInMonths < 1) {
          return `${Math.floor(diffInWeeks)} minggu yang lalu`;
        } else if (diffInYears < 1) {
          return `${Math.floor(diffInMonths)} bulan yang lalu`;
        } else {
          return `${Math.floor(diffInYears)} tahun yang lalu`;
        }
      } else {
        return updateTime.format('HH:mm dddd, D MMMM YYYY');
      }
    }
  }
}



</script>
<style scoped>

</style>
