<template>
  <div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="inputGroup-sizing-default">選擇科名</span>
      <select class="form-select" aria-label="Default select example" v-model="selclass" name="class_id">
              <option :value="cla.id" v-for="(cla, index) in fishdata.data.class" :key="index">{{cla.section_name}}</option>
      </select>
      <span class="input-group-text" id="inputGroup-sizing-default">選擇魚類</span>
      <select class="form-select" aria-label="Default select example" id="selectfish" name="fish_id">
          <option :value="cla.id" v-for="(cla, index) in fishdata.data.class[this.selclass-1].fishs" :key="index">{{cla.name}}</option>
      </select>
    </div>
    {{fishcoordinate.data.fishcoordinates}}
    <div id="map" class="ol-map">
      <div id="popup" class="ol-popup"></div>
    </div>
  </div>
</template>
<script>
import 'ol/ol.css';
import {Circle, Fill, Style} from 'ol/style';
import {Feature, Map, Overlay, View} from 'ol/index';
import {OSM, Vector as VectorSource} from 'ol/source';
import {Point} from 'ol/geom';
import {Tile as TileLayer, Vector as VectorLayer} from 'ol/layer';
import {fromLonLat, useGeographic} from 'ol/proj';
useGeographic();
export default {
  data() {
    return {
      map: null,
      selclass:1,
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
          fishcoordinates:[
            
          ]
        }
      }
    };
  },
  methods:{
    
    initMap(){
      const element = document.getElementById('popup');
      const place = [120.863887,24.657074];
      const cordinates=[
        
      ];
      const point = new Point(place);
      const feature=new Feature({
        geometry:new Point(
          fromLonLat([]),
        )
      });
      const map = new Map({
      target: "map", //對應div id
      view: new View({
          projection: "EPSG:4326",    //使用这个坐标系
          center: [120.863887,24.657074],  //台灣台一座標
          zoom: 14
        
        }),
      layers: [
        new TileLayer({
          source: new OSM() //圖片源頭OpenStreetMap
        }),
        new VectorLayer({
          source: new VectorSource({
            features: [new Feature(point)],
          }),
          style: new Style({
            image: new Circle({
              radius: 4,
              fill: new Fill({color: 'black'}),
            }),
          }),
        }),
      ]
      });
      const popup = new Overlay({
        element: element,
        positioning: 'bottom-center',
        stopEvent: false,
        offset: [0, -10],
      });
      map.addOverlay(popup);

      map.on('moveend', function () {
        const info = document.getElementById('info');
        const view = map.getView();
        const center = view.getCenter();
      });

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
            container: element.parentElement,
            html: true,
            sanitize: false,
            content: formatCoordinate(coordinate),
            placement: 'top',
          });
          $(element).popover('show');
        }
      });
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
      function formatCoordinate(coordinate) {
        return `
          <table>
            <tbody>
              <tr><th>魚名</th><td>飯島式銀鮈</td></tr>
              <tr><th>縣市</th><td>苗栗</td></tr>
              <tr><th>經度</th><td>${coordinate[0].toFixed(6)}</td></tr>
              <tr><th>緯度</th><td>${coordinate[1].toFixed(6)}</td></tr>
            </tbody>
          </table>`;
      }
    },
    async loadData() {
      await axios
      .get('http://localhost:8000/get-coordinate')
      .then(response => (this.fishcoordinate = response))
      .catch(function (error) { // 请求失败处理
        console.log(error);
      });
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
  }
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