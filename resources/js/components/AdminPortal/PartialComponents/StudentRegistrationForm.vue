<template>
<ValidationObserver ref="observer" v-slot="{ invalid }">
    <v-form v-model="valid" ref="form">
        <v-container>
            <fieldset class="form-field-sets">
                <legend class="text-center form-field-set-name">Personal Information</legend>
                <v-container>
                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Student Name" rules="required|alpha_spaces" v-slot="{ errors }">
                                <v-text-field v-model="studentdetail.student_name" :error-messages="errors" label="Student Name*" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Father Name" rules="required|alpha_spaces" v-slot="{ errors }">
                                <v-text-field v-model="studentdetail.father_name" label="Father Name*" required :error-messages="errors"></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Guardian Name" rules="required|" v-slot="{ errors }">
                                <v-select v-model="studentdetail.guardian" :items="guardians" item-text="guardian" item-value="id" label="Guardian*" required :error-messages="errors"></v-select>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Date Of Birth" rules="required" v-slot="{ errors }">
                                <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field :error-messages="errors" v-model="dateOfBrth" label="Date of Birth*" hint="MM/DD/YYYY" persistent-hint v-bind="attrs" @blur="date = parseDate(dateFormatted)" v-on="on" required></v-text-field>
                                    </template>
                                    <v-date-picker required v-model="date" no-title @input="menu1 = false"></v-date-picker>
                                </v-menu>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Gender" rules="required" v-slot="{ errors }">
                                <v-select :error-messages="errors" v-model="studentdetail.gender" :items="genders" item-text="gender" item-value="id" label="Gender*" required></v-select>
                            </validationProvider>
                        </v-col>
                        <v-col cols="6">
                            <v-select v-model="studentdetail.bloodGroup" :items="bloodGroups" item-text="blood_group" item-value="id" label="Blood Group (optional)"></v-select>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Religion" rules="required|alpha_spaces" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.religion" text-field label="Religion" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Phone Number" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" @blur="acceptNumber" v-model="studentdetail.phone_number" label="Phone Number*"></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Guardian Phone Number" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" @blur="guardianNumber" v-model="studentdetail.guardian_phone_number" label="Guardian Phone Number" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field v-model="studentdetail.land_line_number" label="Landline Number"></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="CNIC" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" @blur="acceptCNIC()" v-model="studentdetail.cnic" label="CNIC NO*" required></v-text-field>

                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Email" rules="required|email" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.email" label="Contact Email Account*" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Country" rules="required" v-slot="{ errors }">

                                <v-select :error-messages="errors" item-text="name" item-value="id" :items="allCountry" v-model="studentdetail.country" label="Country*" required></v-select>
                            </ValidationProvider>
                        </v-col>

                        <v-col cols="6">
                            <ValidationProvider name="State" rules="required" v-slot="{ errors }">

                                <v-select :error-messages="errors" item-text="name" item-value="id" :items="allState" v-model="studentdetail.state" label="State*"></v-select>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="City" rules="required" v-slot="{ errors }">

                                <v-select :error-messages="errors" item-text="name" item-value="id" :items="allCity" required v-model="studentdetail.city" label="City*"></v-select>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Address" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.address" label="Address*" required></v-text-field>

                            </ValidationProvider>
                        </v-col>
                    </v-row>
                    <p class="alert-indicate">* indicate that this Fields is Must</p>
                </v-container>
            </fieldset>

            <!-- Personal Info field set  -->
            <fieldset class="form-field-sets">
                <legend class="text-center form-field-set-name">Official Information</legend>
                <v-container>
                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Program" rules="required" v-slot="{ errors }">
                                <v-select :error-messages="errors" v-model="studentdetail.program" :items="programs" item-text="program_title" item-value="id" label="Program" required></v-select>
                            </ValidationProvider>
                        </v-col>

                        <v-col cols="6">
                            <ValidationProvider name="Semester" rules="required" v-slot="{ errors }">
                                <v-select :error-messages="errors" v-model="studentdetail.semester" required :items="semester" label="Current Semester"></v-select>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Shift" rules="required" v-slot="{ errors }">
                                <v-select :error-messages="errors" v-model="studentdetail.shift" :items="shifts" item-text="Shift" item-value="id" label="Shift" required></v-select>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Session Year" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.session_year" label="Session Year" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Roll no" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.roll_no" label="Roll Number" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Registration no" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.reg_no" label="Registration No." required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>
                </v-container>
            </fieldset>
            <!-- Educational Info field set  -->
            <fieldset class="form-field-sets">
                <legend class="text-center form-field-set-name">Educational History</legend>
                <v-container>
                    <v-row>
                        <v-col cols="6">
                            <ValidationProvider name="Marks" rules="required|numeric" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.matric_marks" label="Matriculation Marks" required></v-text-field>
                            </ValidationProvider>
                        </v-col>

                        <v-col cols="6">
                            <ValidationProvider name="Marks" rules="required|numeric" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.secondYear_marks" label="FA\FSC\ICS Marks" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <v-text-field v-model="studentdetail.school" type="text" label="School Name "></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Passing Year" rules="required|numeric|max:4|min:4" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.school_passing_year" type="text" label="Passing Year" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="6">
                            <v-text-field v-model="studentdetail.college" type="text" label="College Name "></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="Passing Year" rules="required|numeric|min:4|max:4" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.college_passing_year" type="text" label="Passing Year" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>
                </v-container>
            </fieldset>
            <!-- Officail Information  -->
            <v-container>
                <p class="fee-addition">Do You want to {{ feeAdd ? 'Modify ' : 'Add' }} Fee Structure?</p>
                <p class="fee-addition">
                    <v-btn color="primary" small @click="dialog =true">{{ feeAdd ? 'Modify ' : 'Add' }} Fee Structure</v-btn>
                </p>
            </v-container>

            <fieldset class="form-field-sets">
                <legend class="text-center form-field-set-name">Login Credentials</legend>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <ValidationProvider name="User Name" rules="required|email" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="studentdetail.user_name" label="User Name" required></v-text-field>
                            </ValidationProvider>
                        </v-col>
                    </v-row>
                    <v-row>

                        <v-col cols="6">
                            <ValidationProvider name="Password" rules="required|password:@confirm|min:8" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" label="Password" type="password" v-model="studentdetail.password" required></v-text-field>
                             
                            </ValidationProvider>
                        </v-col>
                        <v-col cols="6">
                            <ValidationProvider name="confirm" rules="required" v-slot="{ errors }">
                                <v-text-field :error-messages="errors" v-model="confirmation" label="Confirm Password" type="password" autocomplete="false" required></v-text-field>
                            </ValidationProvider>
                        </v-col>

                    </v-row>
                </v-container>
            </fieldset>
            <!-- Login Information End -->

            <v-container class="text-center">
                <v-btn color="primary" @click="registerStudent()" :disabled="invalid">Register Student</v-btn>
            </v-container>

            <!-- Fee Structure Modal -->
            <v-row justify="center">
                <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
                    <v-card>
                        <v-toolbar dark color="primary">
                            <v-btn icon dark @click="dialog=false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                            <v-toolbar-title>Fee Sturcture</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-container>
                            <fieldset class="form-field-sets">
                                <legend class="form-field-set-name">Fee Structure Particulars</legend>
                                <v-container>
                                    <h3 class="text-center">Complete Package of Semester</h3>
                                    <v-divider></v-divider>

                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field label="Admission Fee"></v-text-field>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-text-field label="Tution Fee Per Semester"></v-text-field>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-text-field label="Scholarship %"></v-text-field>
                                        </v-col>

                                        <v-col cols="12">
                                            <v-text-field label="Amount of Scholarship"></v-text-field>
                                        </v-col>

                                        <v-col cols="6">
                                            <v-text-field label="Fee After  Scholarship"></v-text-field>
                                        </v-col>

                                        <v-col cols="6">
                                            <v-text-field label="Library Fee"></v-text-field>
                                        </v-col>

                                        <v-col cols="6">
                                            <v-text-field label="Exam Fee"></v-text-field>
                                        </v-col>

                                        <v-col cols="6">
                                            <v-text-field label="Sport Fee"></v-text-field>
                                        </v-col>

                                        <v-col>
                                            <h5>Total Amount 45000</h5>
                                        </v-col>

                                        <v-col>
                                            <v-btn color="primary" @click="addFee()">Submit Fee</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </fieldset>
                        </v-container>

                        <v-divider></v-divider>
                    </v-card>
                </v-dialog>
            </v-row>
            <!-- Add Fee structure -->
        </v-container>
        <v-snackbar top right v-model="snackbar" color="success">
            {{succesMessage}}
            <template v-slot:action="{ attrs }">
                <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">Close</v-btn>
            </template>
        </v-snackbar>
    </v-form>
</ValidationObserver>
</template>

<script>

import {required,alpha_spaces,alpha_num,numeric,email,min,max,password} from 'vee-validate/dist/rules';
import {extend,ValidationObserver,ValidationProvider,setInteractionMode,} from "vee-validate";

setInteractionMode("eager");

extend('min', {

    ...min,
    message: '{_field_} is less then minimum characters required'
});

extend('max', {
    ...max,
    message: '{_field_} maximum 4 numbers'
});

extend('password', {
    params: ['target'],
    validate(value, {
        target
    }) {
        return value === target;
    },
    message: 'Password confirmation does not match'
});
extend('alpha_spaces', {
    ...alpha_spaces,
    message: '{_field_} contains only alphabets '
});
extend('alpha_num', {
    ...alpha_num,
    message: '{_field_} contains only alphabets and numbers '
});

extend('required', {
    ...required,
    message: '{_field_} can not be empty',
});
extend('email', {
    ...email,
    message: '{_field_} must be valid',
});
extend('numeric', {
    ...numeric,
    message: '{_field_} can only contain numbers',
})
export default {
    name: "StudentRegistratonForm",

    components: {
        ValidationProvider,
        ValidationObserver
    },

    data: vm => ({
        email: "",
        valid: true,
        confirmation: "",
        succesMessage: "",
        snackbar: false,
        allCity:[],
        dialog: false,
        allCountry: [],
        studentdetail: {
            state: '',
            student_name: "",
            father_name: "",
            dateofBirth: "",
            bloodGroup: "",
            gender: "",
            religion: "",
            phone_number: "",
            land_line_number: "",
            country: "",
            city: "",
            email: "",
            cnic: "",
            address: "",
            program: "",
            semester: "",
            shift: "",
            session_year: "",
            roll_no: "",
            reg_no: "",
            matric_marks: "",
            secondYear_marks: "",
            school: "",
            school_passing_year: "",
            college: "",
            college_passing_year: ""
        },
        allState: [],
        TotalSemester: ["1", "2", "3", "4", "5", "6", "7", "8"],
        genders: [],
        guardians: [],
        bloodGroups: [],
        shifts: [],
        allCity: [],
        programs: [],
        semester: ["1", "2", "3", "4", "5", "6", "7", "8"],
        date: new Date().toISOString().substr(0, 10),
        dateFormatted: vm.formatDate(new Date().toISOString().substr(0, 10)),
        menu1: false,
        menu2: false,
        password: "",
        feeAdd: false
    }),

    computed: {
        dateOfBrth:{
            // getter
            get: function () {
                return this.formatDate(this.date);
            },
            // setter
            set: function () {
               return this.formatDate("20/20/2020");
            }

        },
        //User Auth function authorizing Admin & use in Header
        userAuth: function () {
            return cryptoJSON.decrypt( JSON.parse(localStorage.getItem("adminLogin")),"ums");
        },

    },

    watch: {
        date(val) {
            this.dateFormatted = this.formatDate(this.date);
        },
     
    },

    methods: {

        guardianNumber() {
            if (this.studentdetail.guardian_phone_number != null) {
                var x = this.studentdetail.guardian_phone_number
                    .replace(/\D/g, "")
                    .match(/(\d{0,4})(\d{0,7})/);
                this.studentdetail.guardian_phone_number = !x[2] ? x[1] : "(" + x[1] + ") " + x[2];
            }

        },
        acceptNumber() {
            if (this.studentdetail.phone_number != null) {
                var x = this.studentdetail.phone_number
                    .replace(/\D/g, "")
                    .match(/(\d{0,4})(\d{0,7})/);
                this.studentdetail.phone_number = !x[2] ? x[1] : "(" + x[1] + ") " + x[2];
            }

        },
        acceptCNIC() {
            if (this.studentdetail.cnic != null) {
                var x = this.studentdetail.cnic
                    .replace(/\D/g, "")
                    .match(/(\d{0,5})(\d{0,7})(\d{0,1})/);
                this.studentdetail.cnic = !x[2] ?
                    x[1] :
                    x[1] + "-" + x[2] + (x[3] ? "-" + x[3] : "");
            }

        },
        registerStudent: function () {
            this.studentdetail.dateofBirth = this.dateOfBrth;
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/register-student",this.studentdetail, {headers: headers})
                .then(response => {
                    this.succesMessage = "Student Register Successfully";
                    this.snackbar = true;
                    this.$refs.form.reset();
                    this.$refs.observer.reset();
                })
                .catch(error => {});
        },
        // getting gender from Database
        getGender: function () {
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/get-gender", "", {headers: headers})
                .then(response => {
                    this.genders = response.data.data;
                })
                .catch(error => {});
        },

        // getting guardian from Database
        getGuardian: function () {
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/get-guardian", "", {headers: headers})
                .then(response => {
                    this.guardians = response.data.data;
                })
                .catch(error => {});
        },
        // getting shift from Database
        getShift: function () {
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/get-shift", "", {headers: headers})
                .then(response => {
                    this.shifts = response.data.data;
                })
                .catch(error => {});
        },
        getAllCountry: function () {
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            axios.post(process.env.MIX_APP_URL + '/all-country', '', {headers: headers})
                .then((res) => {
                    this.allCountry = res.data.counties;
                    axios.get('http://ip-api.com/json').then(res => {
                        let x = this.allCountry.filter(item => item.name == res.data.country);
                        this.studentdetail.country = x[0].id;
                    })

                })
                .catch((err) => {})
        },
        getAllCities() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            axios.post(process.env.MIX_APP_URL + '/all-cities', '', {headers: headers})
                .then((res) => {
                    this.allCity = res.data.cities;
                    axios.get('http://ip-api.com/json').then(res => {
                        let x = this.allCity.filter(item => item.name == res.data.city);
                        this.studentdetail.city = x[0].id;
                    })

                })
                .catch((err) => {})
        },
        getAllState() {
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            axios.post(process.env.MIX_APP_URL + '/all-states', '', {headers: headers})
                .then((res) => {
                    this.allState = res.data.states;
                    axios.get('http://ip-api.com/json').then(res => {
                        let x = this.allState.filter(item => item.name == res.data.regionName);
                        this.studentdetail.state = x[0].id;
                    })
                })
                .catch((err) => {})
        },
        // getting program from Database
        getProgram: function () {
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/get-all-program", "", {headers: headers})
                .then(response => {
                    this.programs = response.data.data;
                })
                .catch(error => {});
        },

        // getting blood group from Database
        getBloodGroup: function () {
            // Headers are defined for authentication
            let headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer  " + this.userAuth.token
            };
            // send request to Api Route
            axios.post(process.env.MIX_APP_URL + "/get-blood-group", "", {headers: headers})
                .then(response => {
                    this.bloodGroups = response.data.data;
                })
                .catch(error => {});
        },

        addFee: function () {
            this.feeAdd = true;
            this.dialog = !this.dialog;
        },
        formatDate(date) {
            if (!date) return null;
            const [year, month, day] = date.split("-");
            return `${month}/${day}/${year}`;
        },
        parseDate(date) {
            if (!date) return null;
            const [month, day, year] = date.split("/");
            return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
        }
    },
    created() {
        this.getAllCountry();
        this.getAllState();
        this.getAllCities();

        this.getGuardian();
        this.getGender();
        this.getBloodGroup();
        this.getShift();
        this.getProgram();
    }
};
</script>

<style scoped>
.alert-indicate {
    font-size: 11px;
    text-align: right;
}

.form-field-sets {
    padding: 10px;
    border-radius: 6px;
    border-color: rgba(0, 0, 0, 0.12);
    margin-bottom: 10px;
}

.form-field-set-name {
    font-weight: bold;
    color: rgba(0, 0, 0, 0.45);
    padding: 0 10px;
}

.fee-addition {
    font-size: 12px;
}
</style>
