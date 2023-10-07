import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import CityListRow from './CityListRow';

const AJAX_HEADERS = {
    'Content-Type': 'application/json',
    //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest',
    "Accept": "application/json",
    //'Authorization': 'Bearer ' + Laravel.apiKey,
};

export default class CityList extends Component {

    constructor(props) {
        super(props);

        this.state = {
            cities: null,
        };

        this.getCityData = this.getCityData.bind(this);
        this.getCityData();
    }

    getCityData() {
        var thisModel = this;
        //axios.get('/api/varosok-listazasa?api_token=' + Laravel.apiKey)
        axios.get('/api/varosok-listazasa/' + thisModel.props.countyId)
                .then(result => {
                    let dropdownData = [];
                    result.data.data.forEach(function (apiData) {
                        dropdownData.push({id: apiData.id, name: apiData.name});
                    });
                    thisModel.setState({cities: dropdownData});
                });
    }

    componentDidUpdate(prevProps, prevState) {
        if (prevProps.countyId !== this.props.countyId) {
            this.getCityData();
        }
    }

    render() {
        if (this.state.cities == null) {
            return (<div></div>);
        } else {
            return <div className="row">
                <div className="col-lg-12">
                    { this.state.cities.map(city => <CityListRow cityId={city.id} name={city.name} key={city.id} getCityData={this.getCityData}></CityListRow>) }
                </div>
            </div>
        }
    }

}

