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

export default class CityModifier extends Component {

    constructor(props) {
        super(props);

        this.state = {
            cityName: this.props.cityName,
        };
        //reRenderCityList

        this.updateCity = this.updateCity.bind(this);
        this.deleteCity = this.deleteCity.bind(this);
        // this.getCityData();
    }

    updateCity() {

    }

    deleteCity() {
        console.log("asd");
        var thisModel = this;
        //axios.get('/api/varos-listazasa?api_token=' + Laravel.apiKey)
        axios.delete('/api/varos-torlese/' + thisModel.props.cityId, [], AJAX_HEADERS)
                .then(result => {
                    if(result.data.success){
                        this.props.reRenderCityList();
                    } else {
                        alert("törlés sikertelen");
                    }
                });
    }

    render() {
        return (
                <div className="row">
                    <div className="col-lg-6">
                        <input
                            placeholder="Város neve"
                            value={this.props.name}
                            type="text"
                            name="city_name_update"
                            id="city_name_update"
                            className="form-control"
                            onBlur={this.validateTextFieldValue}
                            onChange={(item) => {
                                    this.setState({cityName: item.target.value})
                                }}
                            />
                        <div className="input-error" id={"error-name"}></div>
                
                    </div>
                    <div className="col-lg-6">
                        <button type="button" className="btn btn-error" onClick={this.deleteCity}>Törlés</button>
                        <button type="button" className="btn btn-success" onClick={this.updateCity}>Módosít</button>
                        <button type="button" className="btn btn-secondary" onClick={this.props.changeFormToButton}>Mégsem</button>
                    </div>
                </div>
                )
    }

}

