import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Dropdown from 'react-dropdown';
import NewCitySaver from './NewCitySaver';
import CityList from './CityList';
import 'react-dropdown/style.css';
import axios from 'axios';

export default class Home extends Component {
    constructor(props) {
        super(props);

        this.state = {
            counties: {},
            options: {},
            countyId: null,
            rerenderCounter: 0
        };
        this.getDropdownData = this.getDropdownData.bind(this);
        this.setErrorMessage = this.setErrorMessage.bind(this);
        this.rerenderCityList = this.rerenderCityList.bind(this);
        this.getDropdownData();
    }

    componentDidMount() {
        this.getDropdownData();
    }

    getDropdownData() {
        var thisModel = this;
        //axios.get('/api/varosok-listazasa?api_token=' + Laravel.apiKey)
        axios.get('/api/megyek-listazasa')
                .then(result => {
                    let dropdownData = [];
                    result.data.data.forEach(function (apiData, index) {
                        dropdownData.push({value: apiData.id, label: apiData.name});
                    });

                    thisModel.setState({counties: dropdownData});
                }).catch(function (e) {
            console.log(e);
            document.getElementById("homeDiv").innerHTML = "hiba történt az adatok lekérése során, próbáld újra később";
        });

    }

    setErrorMessage(message) {
        document.getElementById("error-county_id").innerHTML = message;
    }

    rerenderCityList() {
        this.setState({rerenderCounter: this.state.rerenderCounter + 1})
    }

    render() {

        return (
                <div className="home-div" id="homeDiv">
                    <div className="row justify-content-center">
                        <div className="col-md-6"> 
                            <div className="county-dropdown">
                                <Dropdown 
                                    options={this.state.counties} 
                                    onChange={(item) => {
                                            this.setState({countyId: item.value})
                                        }}
                                    placeholder="Select an option" 
                                    />
                                <div className="input-error" id="error-county_id"></div>
                            </div>
                            { this.state.countyId !== null &&
                                    <div className="city-saver">
                                        <NewCitySaver 
                                            countyId={this.state.countyId} 
                                            setErrorMessage={this.setErrorMessage}
                                            rerenderCityList={this.rerenderCityList}
                                            />
                                    </div>
                            }
                        </div>
                
                        <div className="col-md-6"> 
                            {this.state.countyId !== null &&
                                    <CityList 
                                        rerenderCounter={this.state.rerenderCounter}
                                        countyId={this.state.countyId}
                                        />
                            }
                        </div>
                    </div>
                </div>
                );
    }
}


if (document.getElementById('home')) {
    ReactDOM.render(<Home />, document.getElementById('home'));
}
