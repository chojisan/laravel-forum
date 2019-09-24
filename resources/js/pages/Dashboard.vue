<script>
import LineChart from "../components/LineChart.vue";

export default {
  components: {
    LineChart
  },

  created() {
    this.fetch("/threads");
  },

  data() {
    return {
      lineChartDataset: false
    };
  },

  methods: {
    fetch(url) {
      axios.get(url).then(this.refresh);
    },

    refresh({ data }) {
      console.log(data);
      this.lineChartDataset = data;
    }
  }
};
</script>