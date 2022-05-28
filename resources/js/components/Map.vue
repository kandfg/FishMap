<template>
  <div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">選擇科名</span>
      <select class="form-select" aria-label="Default select example" v-model="selclass" id="selectclass" name="class_id">
              <option :value="cla.id" v-for="(cla, index) in fishdata.data.class" :key="index">{{cla.section_name}}</option>
      </select>

      <span class="input-group-text" id="inputGroup-sizing-default">選擇魚類</span>
      <select class="form-select" aria-label="Default select example" v-model="selfish" id="selectfish" name="fish_id">
          <option :value="cla.id" v-for="(cla, index) in fishdata.data.class[this.selclass-1].fishs" :key="index">{{cla.name}}</option>
      </select>
    </div>
    <div id="map" class="ol-map">
      <div id="popup" class="ol-popup"></div>
    </div>
  </div>
</template>
<script>
import 'ol/ol.css';
import {Circle, Stroke,Fill, Style} from 'ol/style';
import {Feature, Map, Overlay, View} from 'ol/index';
import {OSM, Vector as VectorSource} from 'ol/source';
import {Point} from 'ol/geom';
import {Vector} from 'ol/source';
import {Tile as TileLayer} from 'ol/layer';
import {fromLonLat, useGeographic} from 'ol/proj';
import WebGLPointsLayer from 'ol/layer/WebGLPoints';
useGeographic();
export default {
  data() {
    return {
      map: null,
      selclass:1,
      selfish:0,
      fishdata: {
        data:{
          class:[
            {
              fishs:[
              "id",
              "name"
              ]
            },
            "id",
            "section_name"
          ],
        }
      },
      fishcoordinate:{
        data:{
          fishCoordinates:[
            "latitude",
            "longitude",
          ],
        }
      }
    };
  },
  methods:{
    
    initMap(){
      const place = [120.863887,24.657074];
      const map = new Map({
      target: "map", //對應div id
      view: new View({
          projection: "EPSG:4326",    //使用这个坐标系
          center: [120.863887,24.657074],  //台灣台一座標
          zoom: 8
        
        }),
      layers: [
        new TileLayer({
          source: new OSM() //圖片源頭OpenStreetMap
        }),
      ]
      });
      const vectorSource = new Vector({
        features: [],
        attributions: 'Fish Coordinate',
      });
      ;(async () => {
        const fishcoordinate = await axios({
          url: 'http://localhost:8000/get-coordinate',
          method: 'get'
        })
      const features = [];
      Object.values(fishcoordinate.data.fishCoordinates).forEach(element => {
        const coords = [element.longitude,element.latitude];
        features.push(
          new Feature({
            fishName:element.fishs.name,
            place:element.survey_place,
            geometry: new Point(coords),
          })
        );
      });
      vectorSource.addFeatures(features);
      })()
      const style = {
        variables: {
          filterFish: 'all',
        },
        filter: [
          'case',
          ['!=', ['var', 'filterFish'], 'all'],
          ['==', ['get', 'fishName'], ['var', 'filterFish']],
          true,
        ],
        symbol: {
          symbolType: 'circle',
          size: 14,
          color: 'black',
          opacity: 0.5,
        },
      };
      const fishSelect = document.getElementById('selectfish');
      const fishClass = document.getElementById('selectclass');
      fishClass.addEventListener('change', function () {
        style.variables.filterFish ='all';
        map.render();
      });
      fishSelect.addEventListener('change', function () {
        style.variables.filterFish =fishSelect.options[fishSelect.selectedIndex].innerText;
        map.render();
      });
      map.addLayer(
        new WebGLPointsLayer({
        source: vectorSource,
        style:style,
      })
      );

      map.on('moveend', function () {
        const view = map.getView();
        const center = view.getCenter();
      });
      const element = document.getElementById('popup');
      map.on('click', function (event) {
        $(element).popover('dispose');
        const feature = map.getFeaturesAtPixel(event.pixel)[0];
        if (feature) {
          const coordinate = feature.getGeometry().getCoordinates();
          popup.setPosition([
            coordinate[0] + Math.round(event.coordinate[0] / 360) * 360,
            coordinate[1],
          ]);
          $(element).popover({
            container: element,
            html: true,
            sanitize: false,
            content: content(feature.get('fishName'),feature.get('place'),coordinate),
            placement: 'top',
          });
          $(element).popover('show');
        }
      });
      const popup = new Overlay({
        element: element,
        positioning: 'bottom-center',
        stopEvent: false,
        offset: [0, -10],
      });
      function content(name,place,coordinate) {
        return `
          <table>
            <tbody>
              <tr><th>魚名</th><td>${name}</td></tr>
              <tr><th>縣市</th><td>${place}</td></tr>
              <tr><th>經度</th><td>${coordinate[0]}</td></tr>
              <tr><th>緯度</th><td>${coordinate[1]}</td></tr>
            </tbody>
          </table>`;
      }
      map.addOverlay(popup);
      map.on('pointermove', function (event) {
        if (map.hasFeatureAtPixel(event.pixel)) {
          map.getViewport().style.cursor = 'pointer';
        } else {
          map.getViewport().style.cursor = 'inherit';
        }
      });
      map.on('loadstart', function () {
        map.getTargetElement().classList.add('spinner');
      });
      map.on('loadend', function () {
        map.getTargetElement().classList.remove('spinner');
      });
    },

    async loadData() {
      await axios
      .get('http://localhost:8000/get-fish')
      .then(response => (this.fishdata = response))
      .catch(function (error) { // 请求失败处理
        console.log(error);
      });
    },
  },
  mounted() {
    this.loadData();
    this.initMap();
  },
  
};
</script>

<style>
      .ol-map {
        height: 100%;
        width: 100%;
        position:absolute;
      }
      @keyframes spinner {
        to {
          transform: rotate(360deg);
        }
      }
      .ol-popup {
        min-width: 280px;
      }

      .spinner:after {
        content: "";
        box-sizing: border-box;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        margin-top: -20px;
        margin-left: -20px;
        border-radius: 50%;
        border: 5px solid rgba(180, 180, 180, 0.6);
        border-top-color: rgba(0, 0, 0, 0.6);
        animation: spinner 0.6s linear infinite;
      }
</style>