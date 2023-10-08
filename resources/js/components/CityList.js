import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CityListRow from './CityListRow';
import {AJAX_HEADERS} from '../data/request-helper.js';

export default class CityList extends Component {

    constructor(props) {
        super(props);

        this.state = {
            cities: null,
            closeWindows: 0,
        };

        this.getCityData = this.getCityData.bind(this);
        this.closeAllCityModifierWindow = this.closeAllCityModifierWindow.bind(this);
        this.getCityData();
    }

    getCityData(lastElementShouldFadeIn = false) {
        var thisModel = this;
        axios.get('/api/varosok-listazasa/' + thisModel.props.countyId, {}, {headers:AJAX_HEADERS})
                .then(result => {
                    let cityListData = [];
                    let jsonSize = result.data.data.length - 1;
                    result.data.data.forEach(function (apiData, key) {
                        cityListData.push({id: apiData.id, name: apiData.name, fadeIn: (lastElementShouldFadeIn && key == jsonSize)});
                    });
                    thisModel.setState({cities: cityListData});
                }).catch(function (e) {
            console.log(e);
            document.getElementById("cityListDiv").innerHTML = "hiba történt az adatok lekérése során, próbáld újra később";
        });
    }

    componentDidUpdate(prevProps, prevState) {

        let dropdownChangeUpdate = prevProps.countyId !== this.props.countyId;
        let newItemSavedUpdate = prevProps.rerenderCounter !== this.props.rerenderCounter;
        if (dropdownChangeUpdate || newItemSavedUpdate) {
            this.getCityData(newItemSavedUpdate);
        }
    }

    closeAllCityModifierWindow(id) {
        this.setState({closeWindows: id});
    }

    render() {
        if (this.state.cities == null) {
            return (<div id="cityListDiv"></div>);
        } else {
            return <div className="row" id="cityListDiv">
                <div className="col-lg-12">
                    { this.state.cities.map(city =>
                                <CityListRow 
                                    cityId={city.id} 
                                    name={city.name} 
                                    key={city.id} 
                                    fadeIn={city.fadeIn} 
                                    getCityData={this.getCityData}
                                    closeAllCityModifierWindow={this.closeAllCityModifierWindow}
                                    closeWindows={this.state.closeWindows}
                                    ></CityListRow
                                >)
                    }
                </div>
            </div>
        }
    }

}

