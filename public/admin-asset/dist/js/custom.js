
document.addEventListener('DOMContentLoaded', function () {
    // Attach a click event listener to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            // alert("clicked");
            event.preventDefault(); // Prevent the default link behavior

            // Use SweetAlert2 to show a confirmation dialog
            Swal.fire({
                title: 'Are you sure you want to proceed?',
                text: 'Once you delete this project, it will be permanently removed and cannot be recovered.!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the delete URL
                    window.location.href = button.getAttribute('href');
                }
            });
        });
    });
});


var data = {
    states: [
        {
            state: "Andhra Pradesh",
            districts: ["Anantapur", "Chittoor", "East Godavari", "Guntur", "Krishna", "Kurnool", "Nellore", "Prakasam", "Srikakulam", "Visakhapatnam", "Vizianagaram", "West Godavari", "YSR Kadapa"],
        },
        {
            state: "Arunachal Pradesh",
            districts: [
                "Tawang",
                "West Kameng",
                "East Kameng",
                "Papum Pare",
                "Kurung Kumey",
                "Kra Daadi",
                "Lower Subansiri",
                "Upper Subansiri",
                "West Siang",
                "East Siang",
                "Siang",
                "Upper Siang",
                "Lower Siang",
                "Lower Dibang Valley",
                "Dibang Valley",
                "Anjaw",
                "Lohit",
                "Namsai",
                "Changlang",
                "Tirap",
                "Longding",
            ],
        },
        {
            state: "Assam",
            districts: [
                "Baksa",
                "Barpeta",
                "Biswanath",
                "Bongaigaon",
                "Cachar",
                "Charaideo",
                "Chirang",
                "Darrang",
                "Dhemaji",
                "Dhubri",
                "Dibrugarh",
                "Goalpara",
                "Golaghat",
                "Hailakandi",
                "Hojai",
                "Jorhat",
                "Kamrup Metropolitan",
                "Kamrup",
                "Karbi Anglong",
                "Karimganj",
                "Kokrajhar",
                "Lakhimpur",
                "Majuli",
                "Morigaon",
                "Nagaon",
                "Nalbari",
                "Dima Hasao",
                "Sivasagar",
                "Sonitpur",
                "South Salmara-Mankachar",
                "Tinsukia",
                "Udalguri",
                "West Karbi Anglong",
            ],
        },
        {
            state: "Bihar",
            districts: [
                "Araria",
                "Arwal",
                "Aurangabad",
                "Banka",
                "Begusarai",
                "Bhagalpur",
                "Bhojpur",
                "Buxar",
                "Darbhanga",
                "East Champaran (Motihari)",
                "Gaya",
                "Gopalganj",
                "Jamui",
                "Jehanabad",
                "Kaimur (Bhabua)",
                "Katihar",
                "Khagaria",
                "Kishanganj",
                "Lakhisarai",
                "Madhepura",
                "Madhubani",
                "Munger (Monghyr)",
                "Muzaffarpur",
                "Nalanda",
                "Nawada",
                "Patna",
                "Purnia (Purnea)",
                "Rohtas",
                "Saharsa",
                "Samastipur",
                "Saran",
                "Sheikhpura",
                "Sheohar",
                "Sitamarhi",
                "Siwan",
                "Supaul",
                "Vaishali",
                "West Champaran",
            ],
        },
        {
            state: "Chandigarh (UT)",
            districts: ["Chandigarh"],
        },
        {
            state: "Chhattisgarh",
            districts: [
                "Balod",
                "Baloda Bazar",
                "Balrampur",
                "Bastar",
                "Bemetara",
                "Bijapur",
                "Bilaspur",
                "Dantewada (South Bastar)",
                "Dhamtari",
                "Durg",
                "Gariyaband",
                "Janjgir-Champa",
                "Jashpur",
                "Kabirdham (Kawardha)",
                "Kanker (North Bastar)",
                "Kondagaon",
                "Korba",
                "Korea (Koriya)",
                "Mahasamund",
                "Mungeli",
                "Narayanpur",
                "Raigarh",
                "Raipur",
                "Rajnandgaon",
                "Sukma",
                "Surajpur  ",
                "Surguja",
            ],
        },
        {
            state: "Dadra and Nagar Haveli (UT)",
            districts: ["Dadra & Nagar Haveli"],
        },
        {
            state: "Daman and Diu (UT)",
            districts: ["Daman", "Diu"],
        },
        {
            state: "Delhi (NCT)",
            districts: [
                "Central Delhi",
                "East Delhi",
                "New Delhi",
                "North Delhi",
                "North East  Delhi",
                "North West  Delhi",
                "Shahdara",
                "South Delhi",
                "South East Delhi",
                "South West  Delhi",
                "West Delhi",
            ],
        },
        {
            state: "Goa",
            districts: ["North Goa", "South Goa"],
        },
        {
            state: "Gujarat",
            districts: [
                "Ahmedabad",
                "Amreli",
                "Anand",
                "Aravalli",
                "Banaskantha (Palanpur)",
                "Bharuch",
                "Bhavnagar",
                "Botad",
                "Chhota Udepur",
                "Dahod",
                "Dangs (Ahwa)",
                "Devbhoomi Dwarka",
                "Gandhinagar",
                "Gir Somnath",
                "Jamnagar",
                "Junagadh",
                "Kachchh",
                "Kheda (Nadiad)",
                "Mahisagar",
                "Mehsana",
                "Morbi",
                "Narmada (Rajpipla)",
                "Navsari",
                "Panchmahal (Godhra)",
                "Patan",
                "Porbandar",
                "Rajkot",
                "Sabarkantha (Himmatnagar)",
                "Surat",
                "Surendranagar",
                "Tapi (Vyara)",
                "Vadodara",
                "Valsad",
            ],
        },
        {
            state: "Haryana",
            districts: [
                "Ambala",
                "Bhiwani",
                "Charkhi Dadri",
                "Faridabad",
                "Fatehabad",
                "Gurgaon",
                "Hisar",
                "Jhajjar",
                "Jind",
                "Kaithal",
                "Karnal",
                "Kurukshetra",
                "Mahendragarh",
                "Mewat",
                "Palwal",
                "Panchkula",
                "Panipat",
                "Rewari",
                "Rohtak",
                "Sirsa",
                "Sonipat",
                "Yamunanagar",
            ],
        },
        {
            state: "Himachal Pradesh",
            districts: ["Bilaspur", "Chamba", "Hamirpur", "Kangra", "Kinnaur", "Kullu", "Lahaul &amp; Spiti", "Mandi", "Shimla", "Sirmaur (Sirmour)", "Solan", "Una"],
        },
        {
            state: "Jammu and Kashmir",
            districts: [
                "Anantnag",
                "Bandipore",
                "Baramulla",
                "Budgam",
                "Doda",
                "Ganderbal",
                "Jammu",
                "Kargil",
                "Kathua",
                "Kishtwar",
                "Kulgam",
                "Kupwara",
                "Leh",
                "Poonch",
                "Pulwama",
                "Rajouri",
                "Ramban",
                "Reasi",
                "Samba",
                "Shopian",
                "Srinagar",
                "Udhampur",
            ],
        },
        {
            state: "Jharkhand",
            districts: [
                "Bokaro",
                "Chatra",
                "Deoghar",
                "Dhanbad",
                "Dumka",
                "East Singhbhum",
                "Garhwa",
                "Giridih",
                "Godda",
                "Gumla",
                "Hazaribag",
                "Jamtara",
                "Khunti",
                "Koderma",
                "Latehar",
                "Lohardaga",
                "Pakur",
                "Palamu",
                "Ramgarh",
                "Ranchi",
                "Sahibganj",
                "Seraikela-Kharsawan",
                "Simdega",
                "West Singhbhum",
            ],
        },
        {
            state: "Karnataka",
            districts: [
                "Bagalkot",
                "Ballari (Bellary)",
                "Belagavi (Belgaum)",
                "Bengaluru (Bangalore) Rural",
                "Bengaluru (Bangalore) Urban",
                "Bidar",
                "Chamarajanagar",
                "Chikballapur",
                "Chikkamagaluru (Chikmagalur)",
                "Chitradurga",
                "Dakshina Kannada",
                "Davangere",
                "Dharwad",
                "Gadag",
                "Hassan",
                "Haveri",
                "Kalaburagi (Gulbarga)",
                "Kodagu",
                "Kolar",
                "Koppal",
                "Mandya",
                "Mysuru (Mysore)",
                "Raichur",
                "Ramanagara",
                "Shivamogga (Shimoga)",
                "Tumakuru (Tumkur)",
                "Udupi",
                "Uttara Kannada (Karwar)",
                "Vijayapura (Bijapur)",
                "Yadgir",
            ],
        },
        {
            state: "Kerala",
            districts: [
                "Alappuzha",
                "Ernakulam",
                "Idukki",
                "Kannur",
                "Kasaragod",
                "Kollam",
                "Kottayam",
                "Kozhikode",
                "Malappuram",
                "Palakkad",
                "Pathanamthitta",
                "Thiruvananthapuram",
                "Thrissur",
                "Wayanad",
            ],
        },
        {
            state: "Lakshadweep (UT)",
            districts: ["Agatti", "Amini", "Androth", "Bithra", "Chethlath", "Kavaratti", "Kadmath", "Kalpeni", "Kilthan", "Minicoy"],
        },
        {
            state: "Madhya Pradesh",
            districts: [
                "Agar Malwa",
                "Alirajpur",
                "Anuppur",
                "Ashoknagar",
                "Balaghat",
                "Barwani",
                "Betul",
                "Bhind",
                "Bhopal",
                "Burhanpur",
                "Chhatarpur",
                "Chhindwara",
                "Damoh",
                "Datia",
                "Dewas",
                "Dhar",
                "Dindori",
                "Guna",
                "Gwalior",
                "Harda",
                "Hoshangabad",
                "Indore",
                "Jabalpur",
                "Jhabua",
                "Katni",
                "Khandwa",
                "Khargone",
                "Mandla",
                "Mandsaur",
                "Morena",
                "Narsinghpur",
                "Neemuch",
                "Panna",
                "Raisen",
                "Rajgarh",
                "Ratlam",
                "Rewa",
                "Sagar",
                "Satna",
                "Sehore",
                "Seoni",
                "Shahdol",
                "Shajapur",
                "Sheopur",
                "Shivpuri",
                "Sidhi",
                "Singrauli",
                "Tikamgarh",
                "Ujjain",
                "Umaria",
                "Vidisha",
            ],
        },
        {
            state: "Maharashtra",
            districts: [
                "Ahmednagar",
                "Akola",
                "Amravati",
                "Aurangabad",
                "Beed",
                "Bhandara",
                "Buldhana",
                "Chandrapur",
                "Dhule",
                "Gadchiroli",
                "Gondia",
                "Hingoli",
                "Jalgaon",
                "Jalna",
                "Kolhapur",
                "Latur",
                "Mumbai City",
                "Mumbai Suburban",
                "Nagpur",
                "Nanded",
                "Nandurbar",
                "Nashik",
                "Osmanabad",
                "Palghar",
                "Parbhani",
                "Pune",
                "Raigad",
                "Ratnagiri",
                "Sangli",
                "Satara",
                "Sindhudurg",
                "Solapur",
                "Thane",
                "Wardha",
                "Washim",
                "Yavatmal",
            ],
        },
        {
            state: "Manipur",
            districts: [
                "Bishnupur",
                "Chandel",
                "Churachandpur",
                "Imphal East",
                "Imphal West",
                "Jiribam",
                "Kakching",
                "Kamjong",
                "Kangpokpi",
                "Noney",
                "Pherzawl",
                "Senapati",
                "Tamenglong",
                "Tengnoupal",
                "Thoubal",
                "Ukhrul",
            ],
        },
        {
            state: "Meghalaya",
            districts: [
                "East Garo Hills",
                "East Jaintia Hills",
                "East Khasi Hills",
                "North Garo Hills",
                "Ri Bhoi",
                "South Garo Hills",
                "South West Garo Hills ",
                "South West Khasi Hills",
                "West Garo Hills",
                "West Jaintia Hills",
                "West Khasi Hills",
            ],
        },
        {
            state: "Mizoram",
            districts: ["Aizawl", "Champhai", "Kolasib", "Lawngtlai", "Lunglei", "Mamit", "Saiha", "Serchhip"],
        },
        {
            state: "Nagaland",
            districts: ["Dimapur", "Kiphire", "Kohima", "Longleng", "Mokokchung", "Mon", "Peren", "Phek", "Tuensang", "Wokha", "Zunheboto"],
        },
        {
            state: "Odisha",
            districts: [
                "Angul",
                "Balangir",
                "Balasore",
                "Bargarh",
                "Bhadrak",
                "Boudh",
                "Cuttack",
                "Deogarh",
                "Dhenkanal",
                "Gajapati",
                "Ganjam",
                "Jagatsinghapur",
                "Jajpur",
                "Jharsuguda",
                "Kalahandi",
                "Kandhamal",
                "Kendrapara",
                "Kendujhar (Keonjhar)",
                "Khordha",
                "Koraput",
                "Malkangiri",
                "Mayurbhanj",
                "Nabarangpur",
                "Nayagarh",
                "Nuapada",
                "Puri",
                "Rayagada",
                "Sambalpur",
                "Sonepur",
                "Sundargarh",
            ],
        },
        {
            state: "Puducherry (UT)",
            districts: ["Karaikal", "Mahe", "Pondicherry", "Yanam"],
        },
        {
            state: "Punjab",
            districts: [
                "Amritsar",
                "Barnala",
                "Bathinda",
                "Faridkot",
                "Fatehgarh Sahib",
                "Fazilka",
                "Ferozepur",
                "Gurdaspur",
                "Hoshiarpur",
                "Jalandhar",
                "Kapurthala",
                "Ludhiana",
                "Mansa",
                "Moga",
                "Muktsar",
                "Nawanshahr (Shahid Bhagat Singh Nagar)",
                "Pathankot",
                "Patiala",
                "Rupnagar",
                "Sahibzada Ajit Singh Nagar (Mohali)",
                "Sangrur",
                "Tarn Taran",
            ],
        },
        {
            state: "Rajasthan",
            districts: [
                "Ajmer",
                "Alwar",
                "Banswara",
                "Baran",
                "Barmer",
                "Bharatpur",
                "Bhilwara",
                "Bikaner",
                "Bundi",
                "Chittorgarh",
                "Churu",
                "Dausa",
                "Dholpur",
                "Dungarpur",
                "Hanumangarh",
                "Jaipur",
                "Jaisalmer",
                "Jalore",
                "Jhalawar",
                "Jhunjhunu",
                "Jodhpur",
                "Karauli",
                "Kota",
                "Nagaur",
                "Pali",
                "Pratapgarh",
                "Rajsamand",
                "Sawai Madhopur",
                "Sikar",
                "Sirohi",
                "Sri Ganganagar",
                "Tonk",
                "Udaipur",
            ],
        },
        {
            state: "Sikkim",
            districts: ["East Sikkim", "North Sikkim", "South Sikkim", "West Sikkim"],
        },
        {
            state: "Tamil Nadu",
            districts: [
                "Ariyalur",
                "Chennai",
                "Coimbatore",
                "Cuddalore",
                "Dharmapuri",
                "Dindigul",
                "Erode",
                "Kanchipuram",
                "Kanyakumari",
                "Karur",
                "Krishnagiri",
                "Madurai",
                "Nagapattinam",
                "Namakkal",
                "Nilgiris",
                "Perambalur",
                "Pudukkottai",
                "Ramanathapuram",
                "Salem",
                "Sivaganga",
                "Thanjavur",
                "Theni",
                "Thoothukudi (Tuticorin)",
                "Tiruchirappalli",
                "Tirunelveli",
                "Tiruppur",
                "Tiruvallur",
                "Tiruvannamalai",
                "Tiruvarur",
                "Vellore",
                "Viluppuram",
                "Virudhunagar",
            ],
        },
        {
            state: "Telangana",
            districts: [
                "Adilabad",
                "Bhadradri Kothagudem",
                "Hyderabad",
                "Jagtial",
                "Jangaon",
                "Jayashankar Bhoopalpally",
                "Jogulamba Gadwal",
                "Kamareddy",
                "Karimnagar",
                "Khammam",
                "Komaram Bheem Asifabad",
                "Mahabubabad",
                "Mahabubnagar",
                "Mancherial",
                "Medak",
                "Medchal",
                "Nagarkurnool",
                "Nalgonda",
                "Nirmal",
                "Nizamabad",
                "Peddapalli",
                "Rajanna Sircilla",
                "Rangareddy",
                "Sangareddy",
                "Siddipet",
                "Suryapet",
                "Vikarabad",
                "Wanaparthy",
                "Warangal (Rural)",
                "Warangal (Urban)",
                "Yadadri Bhuvanagiri",
            ],
        },
        {
            state: "Tripura",
            districts: ["Dhalai", "Gomati", "Khowai", "North Tripura", "Sepahijala", "South Tripura", "Unakoti", "West Tripura"],
        },
        {
            state: "Uttarakhand",
            districts: ["Almora", "Bageshwar", "Chamoli", "Champawat", "Dehradun", "Haridwar", "Nainital", "Pauri Garhwal", "Pithoragarh", "Rudraprayag", "Tehri Garhwal", "Udham Singh Nagar", "Uttarkashi"],
        },
        {
            state: "Uttar Pradesh",
            districts: [
                "Agra",
                "Aligarh",
                "Allahabad",
                "Ambedkar Nagar",
                "Amethi (Chatrapati Sahuji Mahraj Nagar)",
                "Amroha (J.P. Nagar)",
                "Auraiya",
                "Azamgarh",
                "Baghpat",
                "Bahraich",
                "Ballia",
                "Balrampur",
                "Banda",
                "Barabanki",
                "Bareilly",
                "Basti",
                "Bhadohi",
                "Bijnor",
                "Budaun",
                "Bulandshahr",
                "Chandauli",
                "Chitrakoot",
                "Deoria",
                "Etah",
                "Etawah",
                "Faizabad",
                "Farrukhabad",
                "Fatehpur",
                "Firozabad",
                "Gautam Buddha Nagar",
                "Ghaziabad",
                "Ghazipur",
                "Gonda",
                "Gorakhpur",
                "Hamirpur",
                "Hapur (Panchsheel Nagar)",
                "Hardoi",
                "Hathras",
                "Jalaun",
                "Jaunpur",
                "Jhansi",
                "Kannauj",
                "Kanpur Dehat",
                "Kanpur Nagar",
                "Kanshiram Nagar (Kasganj)",
                "Kaushambi",
                "Kushinagar (Padrauna)",
                "Lakhimpur - Kheri",
                "Lalitpur",
                "Lucknow",
                "Maharajganj",
                "Mahoba",
                "Mainpuri",
                "Mathura",
                "Mau",
                "Meerut",
                "Mirzapur",
                "Moradabad",
                "Muzaffarnagar",
                "Pilibhit",
                "Pratapgarh",
                "RaeBareli",
                "Rampur",
                "Saharanpur",
                "Sambhal (Bhim Nagar)",
                "Sant Kabir Nagar",
                "Shahjahanpur",
                "Shamali (Prabuddh Nagar)",
                "Shravasti",
                "Siddharth Nagar",
                "Sitapur",
                "Sonbhadra",
                "Sultanpur",
                "Unnao",
                "Varanasi",
            ],
        },
        {
            state: "West Bengal",
            districts: [
                "Alipurduar",
                "Bankura",
                "Birbhum",
                "Burdwan (Bardhaman)",
                "Cooch Behar",
                "Dakshin Dinajpur (South Dinajpur)",
                "Darjeeling",
                "Hooghly",
                "Howrah",
                "Jalpaiguri",
                "Kalimpong",
                "Kolkata",
                "Malda",
                "Murshidabad",
                "Nadia",
                "North 24 Parganas",
                "Paschim Medinipur (West Medinipur)",
                "Purba Medinipur (East Medinipur)",
                "Purulia",
                "South 24 Parganas",
                "Uttar Dinajpur (North Dinajpur)",
            ],
        },
    ],
};

document.addEventListener("DOMContentLoaded", function () {
    const selectState = document.getElementById("state");
    const selectDistrict = document.getElementById("district");

    // Ensure both elements are present
    if (!selectState || !selectDistrict) {
        // console.error('Required elements not found in the DOM.');
        return;
    }

    // Disable district select initially
    selectDistrict.disabled = true;

    // Add State Value to State Select option
    if (data && data.states) {
        data.states.forEach((value) => {
            selectState.appendChild(createOption(value.state, value.state));
        });
    } else {
        console.error('Data or data.states is undefined.');
    }

    selectState.addEventListener("change", function (e) {
        selectDistrict.disabled = false;
        if (data && data.states) {
            data.states.forEach((detail, index) => {
                if (detail.state === e.target.value) {
                    selectDistrict.innerHTML = "";
                    selectDistrict.append(createOption("Select District", ""));
                    detail.districts.forEach((district) => {
                        selectDistrict.append(createOption(district, district));
                    });
                }
            });
        } else {
            console.error('Data or data.states is undefined.');
        }
    });

    // Create New Option Tag With Value
    function createOption(displayMember, valueMember) {
        const newOption = document.createElement("option");
        newOption.value = valueMember;
        newOption.text = displayMember;
        return newOption;
    }
});



$(function () {
    // // Custom validator to check the starting digit of phone number
    // $.validator.addMethod("phoneStartingDigit", function (value, element) {
    //     return this.optional(element) || /^[6-9]\d*$/.test(value);
    // }, "Phone number must start with 6, 7, 8, or 9.");

    $("#quickForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            state: {
                required: true
            },
            district: {
                required: true
            },
            address: {
                required: true,
                minlength: 5
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 6
            }
        },
        messages: {
            name: {
                required: "Please enter a branch name",
                minlength: "Branch name must be at least 3 characters long"
            },
            state: {
                required: "Please select a state"
            },
            district: {
                required: "Please select a district"
            },
            address: {
                required: "Please enter an address",
                minlength: "Address must be at least 5 characters long"
            },
            pin_code: {
                required: "Please enter a pincode",
                digits: "Pincode must contain only digits",
                minlength: "Pincode must be at least 5 digits long",
                maxlength: "Pincode must be at most 6 digits long"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $("#managerFormValidation").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            fathers_name: {
                required: true,
                minlength: 3
            },
            dob: {
                required: true,
                date: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15,
                phoneStartingDigit: true
            },
            aadhar_image: {
                required: true,
                extension: "pdf"
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 3 characters long"
            },
            fathers_name: {
                required: "Please enter your father's name",
                minlength: "Your father's name must be at least 3 characters long"
            },
            dob: {
                required: "Please enter your date of birth",
                date: "Please enter a valid date"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            phone_number: {
                required: "Please enter your phone number",
                digits: "Please enter only digits",
                minlength: "Your phone number must be at least 10 digits long",
                maxlength: "Your phone number must be no more than 15 digits long",
                phoneStartingDigit: "Your phone number must start with 6, 7, 8, or 9"
            },
            aadhar_image: {
                required: "Please upload your Aadhar card photo",
                extension: "Please upload a file in pdf format"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});

$(document).ready(function () {
    $(document).on('click', '.add-file-btn', function () {
        var fileFieldHtml = `
            <div class="row file-upload-row">
                <div class="form-group">
                    <input type="file" name="files[]" class="form-control">
                    <button type="button" class="btn btn-danger btn-sm remove-file-btn">Remove</button>
                </div>
            </div>`;
        $('#file-upload-container').append(fileFieldHtml);
    });

    // Function to remove a file upload field
    $(document).on('click', '.remove-file-btn', function () {
        $(this).closest('.file-upload-row').remove();
    });

    // Get the current date
    var today = new Date();

    // Format the date as YYYY-MM-DD
    var formattedDate = today.toISOString().split('T')[0];

    // Set the date input value to the current date
    $('#date').val(formattedDate);


    $("#expanseForm").validate({
        rules: {
            title: {
                required: true
            },
            purpose: {
                required: true
            },
            amount: {
                required: true,
                number: true,
                min: 1
            },
            date: {
                required: true,
                date: true,
                max: '{{ \Carbon\Carbon::now()->format("Y-m-d") }}' // Ensures no future dates are selected
            },
            'file[]': {
                required: false,
                extension: "pdf|doc|docx|jpg|png|jpeg"
            }
        },
        messages: {
            title: {
                required: "Please enter the title"
            },
            purpose: {
                required: "Please select the purpose"
            },
            amount: {
                required: "Please enter the amount",
                number: "Amount must be a number",
                min: "Amount must be greater than 0"
            },
            date: {
                required: "Please select the date",
                date: "Please enter a valid date",
                max: "Future dates are not allowed"
            },
            'file[]': {
                required: "Please upload a file",
                extension: "File must be in one of the following formats: pdf, doc, docx, jpg, png, jpeg"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },

    });
});

